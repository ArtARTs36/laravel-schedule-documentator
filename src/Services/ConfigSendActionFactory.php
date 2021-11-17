<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Services;

use ArtARTs36\CiGitSender\Action\SendAction;
use ArtARTs36\CiGitSender\Commit\Message;
use ArtARTs36\CiGitSender\Factory\SenderFactory;
use ArtARTs36\CiGitSender\Remote\Credentials;
use Illuminate\Contracts\Config\Repository;

class ConfigSendActionFactory
{
    public function __construct(protected Repository $config)
    {
        //
    }

    public function create(): SendAction
    {
        $config = $this->config->get('schedule_doc.git');

        return new SendAction(
            SenderFactory::local($config['bin'])
                ->create($config['dir'], Credentials::fromArray($config['remote'])),
            new Message($config['commit']['message'])
        );
    }
}
