<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Services;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\FriendlySchedule;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleAdapter extends Schedule implements FriendlySchedule
{
    public function getEvents(): array
    {
        return $this->events;
    }

    public function isEventsExists(): bool
    {
        return count($this->events) > 0;
    }
}