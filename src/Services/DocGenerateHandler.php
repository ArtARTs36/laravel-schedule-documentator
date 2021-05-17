<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Services;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\DataFetcher;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
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
        return $this->handleOnDocumentator($this->documentators->factory($ext), $path);
    }

    public function handleOnDocumentator(Documentator $documentator, string $path): Document
    {
        return $documentator->document($this->data->fetch(new ScheduleAdapter($this->schedule)), $path);
    }
}
