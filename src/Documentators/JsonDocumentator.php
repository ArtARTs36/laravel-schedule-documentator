<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\DocumentContent;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventData;
use ArtARTs36\LaravelScheduleDocumentator\Data\StringDocumentContent;

class JsonDocumentator extends AbstractDocumentator implements Documentator
{
    public function content(EventCollection $events): DocumentContent
    {
        return new StringDocumentContent(json_encode($this->eventsToArray($events), JSON_PRETTY_PRINT));
    }

    public function eventsToArray(EventCollection $events): array
    {
        return [
            'events' => array_map(function (EventData $event) {
                return [
                    'command' => [
                        'signature' => $event->command->signature,
                        'description' => $event->command->description,
                    ],
                    'frequency' => [
                        'value' => $event->frequency->value(),
                        'clear_name' => $event->frequency->toClearName(),
                    ],
                ];
            }, $events->all()),
        ];
    }
}
