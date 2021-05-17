<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Data\Document;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventData;

class JsonDocumentator extends AbstractDocumentator implements Documentator
{
    public function document(EventCollection $events, string $path): Document
    {
        $json = json_encode($this->eventsToArray($events), JSON_PRETTY_PRINT);

        return $this->saveContent($path, $json);
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
