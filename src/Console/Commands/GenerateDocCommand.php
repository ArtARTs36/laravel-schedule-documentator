<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Console\Commands;

use ArtARTs36\LaravelScheduleDocumentator\Services\DocGenerateHandler;
use ArtARTs36\LaravelScheduleDocumentator\Services\ConfigSendActionFactory;
use Illuminate\Console\Command;

class GenerateDocCommand extends Command
{
    protected $signature = 'schedule:doc {format} {path} {--ci}';

    protected $description = 'Generate doc for schedule events';

    public function handle(DocGenerateHandler $generator, ConfigSendActionFactory $ci)
    {
        $doc = $generator->handle($this->argument('format'), $this->argument('path'));

        if ($doc->isFresh()) {
            $this->info('Documentation updated');

            if ($this->option('ci')) {
                $ci->create()->send($doc->path());

                $this->info('Documentation committed');
            }
        } else {
            $this->info('Documentation is actually');
        }
    }
}
