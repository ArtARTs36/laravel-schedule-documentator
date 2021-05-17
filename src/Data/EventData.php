<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Data;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Frequency;

class EventData
{
    public $command;

    public $frequency;

    public function __construct(CommandData $command, Frequency $frequency)
    {
        $this->command = $command;
        $this->frequency = $frequency;
    }
}
