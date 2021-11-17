<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Console\Commands;

use ArtARTs36\CiGitSender\Action\SendAction;
use ArtARTs36\LaravelScheduleDocumentator\Services\DocGenerateHandler;
use Illuminate\Console\Command;

class GenerateDocCommand extends Command
{
    protected $signature = 'schedule:doc {format} {path} {--ci}';

    protected $description = 'Generate doc for schedule events';

    public function handle(DocGenerateHandler $generator, SendAction $ci)
    {
        $doc = $generator->handle($this->argument('format'), $this->argument('path'));

        if ($this->option('ci') && $doc->isFresh()) {
            $ci->send($doc->path());
        }
    }
}
