<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Contracts;

interface Frequency
{
    /**
     * Get frequency value
     */
    public function value(): string;

    /**
     * Get readable text
     */
    public function toClearName(): string;
}
