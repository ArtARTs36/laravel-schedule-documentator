<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Data;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\DocumentContent;

class FileDocumentContent implements DocumentContent
{
    protected $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function get(): string
    {
        return file_get_contents($this->path);
    }
}
