<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\DocumentContent;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\StringDocumentContent;
use ArtARTs36\LaravelScheduleDocumentator\Exceptions\TemplateNotFound;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\View\Factory;

class MarkdownDocumentator extends TemplateDocumentator implements Documentator
{
    //
}
