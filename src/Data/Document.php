<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Data;

class Document
{
    protected $path;

    protected $fresh;

    public function __construct(string $path, bool $fresh)
    {
        $this->path = $path;
        $this->fresh = $fresh;
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

    public function isFresh(): bool
    {
        return $this->fresh;
    }
}
