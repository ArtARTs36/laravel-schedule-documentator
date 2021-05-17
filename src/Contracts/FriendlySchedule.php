<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Contracts;

use Illuminate\Console\Scheduling\Event;

interface FriendlySchedule
{
    /**
     * @return array<Event>
     */
    public function getEvents(): array;

    public function isEventsExists(): bool;
}