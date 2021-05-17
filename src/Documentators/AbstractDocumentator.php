<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Data\Document;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use Illuminate\Contracts\Filesystem\Filesystem;

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
        $this->files->put($path, $content);

        return new Document($path);
    }
}
