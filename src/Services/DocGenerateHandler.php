<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Services;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\DataFetcher;
use ArtARTs36\LaravelScheduleDocumentator\Data\Document;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory;
use Illuminate\Console\Scheduling\Schedule;

class DocGenerateHandler
{
    protected $documentators;

    protected $data;

    protected $schedule;

    public function __construct(
        DocumentatorFactory $documentators,
        DataFetcher $data,
        Schedule $schedule
    ) {
        $this->documentators = $documentators;
        $this->data = $data;
        $this->schedule = $schedule;
    }

    public function handle(string $ext, string $path): Document
    {
        return $this
            ->documentators
            ->factory($ext)
            ->document($this->data->fetch(new ScheduleAdapter($this->schedule)), $path);
    }
}
