<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\DocumentContent;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventData;
use ArtARTs36\LaravelScheduleDocumentator\Data\StringDocumentContent;
use Illuminate\Filesystem\Filesystem;

class CsvDocumentator extends AbstractDocumentator implements Documentator
{
    protected $separator;

    protected $headers = [
        'command_signature',
        'command_description',
        'frequency_value',
        'frequency_clear_name',
    ];

    public function __construct(Filesystem $files, string $separator)
    {
        parent::__construct($files);

        $this->separator = $separator;
    }

    public function content(EventCollection $events): DocumentContent
    {
        $csv = implode($this->separator, $this->headers);

        foreach ($events as $event) {
            $csv .= "\n". implode($this->separator, $this->prepareValues($event));
        }

        return new StringDocumentContent($csv);
    }

    /**
     * @return array<string>
     */
    protected function prepareValues(EventData $event): array
    {
        return [
            $event->command->signature,
            $event->command->description,
            $event->frequency->value(),
            $event->frequency->toClearName(),
        ];
    }
}
