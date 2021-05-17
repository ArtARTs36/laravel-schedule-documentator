<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Data\Document;
use Illuminate\Contracts\Filesystem\Filesystem;

abstract class AbstractDocumentator
{
    protected $files;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    protected function saveContent(string $path, string $content): Document
    {
        $this->files->put($path, $content);

        return new Document($path);
    }
}
