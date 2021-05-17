<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Services;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\DataFetcher;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\FriendlySchedule;
use ArtARTs36\LaravelScheduleDocumentator\Data\CommandData;
use ArtARTs36\LaravelScheduleDocumentator\Data\CronFrequency;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventData;
use Illuminate\Console\Application;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command;

class FromApplicationDataFetcher implements DataFetcher
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function fetch(FriendlySchedule $schedule): EventCollection
    {
        if (! $schedule->isEventsExists()) {
            return new EventCollection([]);
        }

        $events = [];

        $artisanBinary = Application::artisanBinary();

        foreach ($schedule->getEvents() as $event) {
            if (! Str::contains($event->command, $artisanBinary)) {
                continue;
            }

            $command = $this->app->get($this->extractCommandName($event->command, $artisanBinary));

            $events[] = new EventData(
                new CommandData(
                    $event->command,
                    $command ? $command->getDescription() : ''
                ),
                new CronFrequency($event->expression)
            );
        }

        return new EventCollection($events);
    }

    protected function getCommand(string $command): ?Command
    {
        if (! $this->app->has($command)) {
            return null;
        }

        return $this->app->get($command);
    }

    protected function extractCommandName(string $command, string $artisan): string
    {
        $position = mb_strpos($command, $artisan);
        $command = trim(mb_substr($command, $position + mb_strlen($artisan)));
        $parts = explode(' ', $command);

        return $parts[0];
    }
}
