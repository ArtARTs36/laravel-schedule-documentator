<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Contracts;

use Illuminate\Console\Scheduling\Event;

interface FriendlySchedule
{
    /**
     * Get all events
     * @return array<Event>
     */
    public function getEvents(): array;

    /**
     * Is events exists
     */
    public function isEventsExists(): bool;
}
