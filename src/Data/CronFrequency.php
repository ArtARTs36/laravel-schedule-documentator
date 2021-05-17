<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Data;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Frequency;
use Lorisleiva\CronTranslator\CronTranslator;

class CronFrequency implements Frequency
{
    protected $expression;

    public function __construct(string $expression)
    {
        $this->expression = $expression;
    }

    public function value(): string
    {
        return $this->expression;
    }

    public function toClearName(): string
    {
        return CronTranslator::translate($this->expression);
    }
}
