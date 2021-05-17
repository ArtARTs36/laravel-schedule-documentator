<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Contracts;

use ArtARTs36\LaravelScheduleDocumentator\Data\Document;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;

interface Documentator
{
    public function document(EventCollection $events, string $path): Document;

    public function content(EventCollection $events): DocumentContent;
}
