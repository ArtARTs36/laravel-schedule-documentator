<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Data\Document;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use Illuminate\Filesystem\Filesystem;

abstract class AbstractDocumentator implements Documentator
{
    protected $files;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function document(EventCollection $events, string $path): Document
    {
        return $this->saveContent($path, $this->content($events)->get());
    }

    protected function saveContent(string $path, string $content): Document
    {
        $prevHash = $this->files->exists($path) ? $this->files->hash($path) : '';

        $this->files->put($path, $content);

        return new Document($path, $prevHash !== $this->files->hash($path));
    }
}
