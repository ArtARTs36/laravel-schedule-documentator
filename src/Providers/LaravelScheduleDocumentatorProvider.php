<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Providers;

use ArtARTs36\CiGitSender\Action\SendAction;
use ArtARTs36\CiGitSender\Commit\Message;
use ArtARTs36\CiGitSender\Factory\SenderFactory;
use ArtARTs36\CiGitSender\Remote\Credentials;
use ArtARTs36\LaravelScheduleDocumentator\Console\Commands\GenerateDocCommand;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\DataFetcher;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\CsvDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\MarkdownDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Services\FromKernelDataFetcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;

class LaravelScheduleDocumentatorProvider extends ServiceProvider
{
    public $bindings = [
        DataFetcher::class => FromKernelDataFetcher::class,
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/schedule_doc.php', 'schedule_doc');

        if ($this->app->runningInConsole()) {
            $this->commands(GenerateDocCommand::class);

            $this
                ->app
                ->when(GenerateDocCommand::class)
                ->needs(SendAction::class)
                ->give(function () {
                    $config = config('schedule_doc.git');

                    return new SendAction(
                        SenderFactory::local($config['bin'])
                            ->create($config['dir'], Credentials::fromArray($config['remote'])),
                        new Message($config['commit']['message'])
                    );
                });

            $this->publishSelfPackage();
        }

        $this->registerDocumentatorFactory();
        $this->registerMarkdownDocumentator();
        $this->registerCsvDocumentator();

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'schedule_doc');
    }

    protected function publishSelfPackage(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/schedule_doc.php' => config_path('schedule_doc.php'),
        ], 'schedule_doc');
    }

    protected function registerDocumentatorFactory(): void
    {
        $this->app->bind(DocumentatorFactory::class, function () {
            return new DocumentatorFactory($this->app, config('schedule_doc.ext_documentator'));
        });
    }

    protected function registerMarkdownDocumentator(): void
    {
        $this->app->bind(MarkdownDocumentator::class, function () {
            return new MarkdownDocumentator(
                $this->app->make(Filesystem::class),
                $this->app->make(Factory::class),
                config('schedule_doc.documentators.markdown.template')
            );
        });
    }

    protected function registerCsvDocumentator(): void
    {
        $this->app->bind(CsvDocumentator::class, function () {
            return new CsvDocumentator(
                $this->app->make(Filesystem::class),
                config('schedule_doc.documentators.csv.separator')
            );
        });
    }
}
