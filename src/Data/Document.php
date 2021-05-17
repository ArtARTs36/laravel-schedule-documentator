<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Data;

class Document
{
    protected $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function extension(): string
    {
        return pathinfo($this->path, PATHINFO_EXTENSION);
    }

    public function name(): string
    {
        return pathinfo($this->path, PATHINFO_FILENAME);
    }

    public function dir(): string
    {
        return pathinfo($this->path, PATHINFO_DIRNAME);
    }
}
