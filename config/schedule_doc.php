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
    'git' => [
        'bin' => 'git',
        'dir' => base_path(),
        'remote' => [
            'login' => 'my-login',
            'token' => env('SCHEDULE_DOCUMENTATOR_GIT_TOKEN', ''),
        ],
        'commit' => [
            'message' => '[DOCS] Build schedule documentation',
        ],
    ],
];
