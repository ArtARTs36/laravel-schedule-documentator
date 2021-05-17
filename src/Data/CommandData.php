<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Data;

class CommandData
{
    public $signature;

    public $description;

    public function __construct(string $signature, string $description)
    {
        $this->signature = $signature;
        $this->description = $description;
    }
}
