<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Data;

class FrequencyData
{
    public $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
