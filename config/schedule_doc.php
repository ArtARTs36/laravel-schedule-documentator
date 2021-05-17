<?php

use ArtARTs36\LaravelScheduleDocumentator\Documentators\CsvDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\JsonDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\MarkdownDocumentator;

return [
    'ext_documentator' => [
        'json' => JsonDocumentator::class,
        'csv' => CsvDocumentator::class,
        'md' => MarkdownDocumentator::class,
    ],
    'documentators' => [
        'markdown' => [
            'template' => 'schedule_doc::doc_markdown',
        ],
        'csv' => [
            'separator' => ';',
        ],
    ],
];
