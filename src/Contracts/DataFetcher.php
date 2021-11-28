<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Contracts;

use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;

interface DataFetcher
{
    /**
     * Fetch events
     */
    public function fetch(FriendlySchedule $schedule): EventCollection;
}
