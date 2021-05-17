<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Services;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\FriendlySchedule;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleAdapter implements FriendlySchedule
{
    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function getEvents(): array
    {
        return $this->schedule->events();
    }

    public function isEventsExists(): bool
    {
        return count($this->schedule->events()) > 0;
    }

    public function getSchedule(): Schedule
    {
        return $this->schedule;
    }
}
