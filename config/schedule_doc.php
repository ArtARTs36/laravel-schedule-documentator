<?php

use ArtARTs36\LaravelScheduleDocumentator\Documentators\CsvDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\JsonDocumentator;

return [
    'ext_documentator' => [
        'json' => JsonDocumentator::class,
        'csv' => CsvDocumentator::class,
    ],
    'documentators' => [
        'markdown' => [
            'template' => 'schedule_doc::doc_markdown',
        ],
    ],
];
