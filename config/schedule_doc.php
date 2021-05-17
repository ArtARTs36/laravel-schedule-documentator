<?php

use ArtARTs36\LaravelScheduleDocumentator\Documentators\CsvDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\JsonDocumentator;

return [
    'documentators' => [
        'json' => JsonDocumentator::class,
        'csv' => CsvDocumentator::class,
    ],
];
