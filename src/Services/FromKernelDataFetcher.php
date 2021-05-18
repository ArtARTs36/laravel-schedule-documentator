<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Services;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\DataFetcher;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\Frequency;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\FriendlySchedule;
use ArtARTs36\LaravelScheduleDocumentator\Data\CommandData;
use ArtARTs36\LaravelScheduleDocumentator\Data\CronFrequency;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventData;
use Illuminate\Console\Application;
use Illuminate\Console\Scheduling\Event;
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
        if (! $schedule->isEventsExists()) {
            return new EventCollection([]);
        }

        $commands = $this->getCommands();
        $artisanBinary = Application::artisanBinary();

        $events = [];

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
                $this->createFrequency($event)
            );
        }

        return new EventCollection($events);
    }

    /**
     * @return array<string, \Symfony\Component\Console\Command\Command>
     */
    protected function getCommands(): array
    {
        return $this->kernel->all();
    }

    protected function createFrequency(Event $event): Frequency
    {
        return new CronFrequency($event->expression);
    }

    protected function extractCommandName(string $command, string $artisan): string
    {
        $position = mb_strpos($command, $artisan);
        $command = trim(mb_substr($command, $position + mb_strlen($artisan)));
        $parts = explode(' ', $command);

        return $parts[0];
    }
}
