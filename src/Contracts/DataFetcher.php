<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Contracts;

use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;

interface DataFetcher
{
    public function fetch(FriendlySchedule $schedule): EventCollection;
}
