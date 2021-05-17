<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Services;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\DataFetcher;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\FriendlySchedule;
use ArtARTs36\LaravelScheduleDocumentator\Data\CommandData;
use ArtARTs36\LaravelScheduleDocumentator\Data\CronFrequency;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventData;
use Illuminate\Console\Application;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Str;

class FromKernelDataFetcher implements DataFetcher
{
    protected $kernel;

    public function __construct(Kernel $app)
    {
        $this->kernel = $app;
    }

    public function fetch(FriendlySchedule $schedule): EventCollection
    {
        $commands = $this->kernel->all();

        if (! $schedule->isEventsExists()) {
            return new EventCollection([]);
        }

        $events = [];

        $artisanBinary = Application::artisanBinary();

        foreach ($schedule->getEvents() as $event) {
            if (! Str::contains($event->command, $artisanBinary)) {
                continue;
            }

            $command = $commands[$this->extractCommandName($event->command, $artisanBinary)] ?? null;

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

    protected function extractCommandName(string $command, string $artisan): string
    {
        $position = mb_strpos($command, $artisan);
        $command = trim(mb_substr($command, $position + mb_strlen($artisan)));
        $parts = explode(' ', $command);

        return $parts[0];
    }
}
