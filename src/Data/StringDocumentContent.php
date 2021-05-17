<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Data;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\DocumentContent;

class StringDocumentContent implements DocumentContent
{
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function get(): string
    {
        return $this->content;
    }
}
