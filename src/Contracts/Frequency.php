<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Contracts;

interface Frequency
{
    public function value(): string;

    public function toClearName(): string;
}
