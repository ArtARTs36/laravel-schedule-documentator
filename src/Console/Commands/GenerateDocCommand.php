<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Console\Commands;

use ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory;
use ArtARTs36\LaravelScheduleDocumentator\Services\DocGenerateHandler;
use Illuminate\Console\Command;

class GenerateDocCommand extends Command
{
    protected $signature = 'schedule:doc {format} {path}';

    protected $description = 'Generate doc for schedule events';

    public function handle(DocGenerateHandler $generator)
    {
        $generator->handle($this->argument('format'), $this->argument('path'));
    }
}
