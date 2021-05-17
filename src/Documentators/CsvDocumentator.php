<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\DocumentContent;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\StringDocumentContent;

class CsvDocumentator extends AbstractDocumentator implements Documentator
{
    public function content(EventCollection $events): DocumentContent
    {
        $csv = 'command_signature;command_description;frequency_value;frequency_clear_name;';

        foreach ($events as $event) {
            $csv .= "\n{$event->command->signature};".
                "{$event->command->description};".
                "{$event->frequency->value()};".
                "{$event->frequency->toClearName()}";
        }

        return new StringDocumentContent($csv);
    }
}
