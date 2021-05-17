<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Data\Document;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;

class CsvDocumentator extends AbstractDocumentator implements Documentator
{
    public function document(EventCollection $events, string $path): Document
    {
        return $this->saveContent($path, $this->getCsvContent($events));
    }

    public function getCsvContent(EventCollection $events): string
    {
        $csv = 'command_signature;command_description;frequency_value;frequency_clear_name;';

        foreach ($events as $event) {
            $csv .= "\n{$event->command->signature};".
                "{$event->command->description};".
                "{$event->frequency->value()};".
                "{$event->frequency->toClearName()}";
        }

        return $csv;
    }
}
