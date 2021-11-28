<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Providers;

use ArtARTs36\LaravelScheduleDocumentator\Console\Commands\GenerateDocCommand;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\DataFetcher;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\CsvDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\MarkdownDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Services\FromKernelDataFetcher;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;

/**
 * @property Container $container
 */
class LaravelScheduleDocumentatorProvider extends ServiceProvider
{
    public array $bindings = [
        DataFetcher::class => FromKernelDataFetcher::class,
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/schedule_doc.php', 'schedule_doc');

        if ($this->app->runningInConsole()) {
            $this->commands(GenerateDocCommand::class);

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
        ], 'config');
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
