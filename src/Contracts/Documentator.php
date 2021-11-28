<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Contracts;

use ArtARTs36\LaravelScheduleDocumentator\Data\Document;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;

interface Documentator
{
    /**
     * Create Document of events
     */
    public function document(EventCollection $events, string $path): Document;

    /**
     * Create Document content of events
     */
    public function content(EventCollection $events): DocumentContent;
}
