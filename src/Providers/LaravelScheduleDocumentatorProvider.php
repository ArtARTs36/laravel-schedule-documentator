<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Providers;

use ArtARTs36\LaravelScheduleDocumentator\Console\Commands\GenerateDocCommand;
use ArtARTs36\LaravelScheduleDocumentator\Contracts\DataFetcher;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\CsvDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\MarkdownDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Services\FromKernelDataFetcher;
use Illuminate\Contracts\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;

class LaravelScheduleDocumentatorProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(DataFetcher::class, FromKernelDataFetcher::class);

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
            __DIR__ . '/../../config/schedule_doc.php' => $this->app->configPath('schedule_doc.php'),
        ], 'config');
    }

    protected function registerDocumentatorFactory(): void
    {
        $this->app->bind(DocumentatorFactory::class, static function (Container $container) {
            return new DocumentatorFactory($container, $container->get('config')->get('schedule_doc.ext_documentator'));
        });
    }

    protected function registerMarkdownDocumentator(): void
    {
        $this->app->bind(MarkdownDocumentator::class, static function (Container $container) {
            return new MarkdownDocumentator(
                $container->make(Filesystem::class),
                $container->make(Factory::class),
                $container->get('config')->get('schedule_doc.documentators.markdown.template')
            );
        });
    }

    protected function registerCsvDocumentator(): void
    {
        $this->app->bind(CsvDocumentator::class, static function (Container $container) {
            return new CsvDocumentator(
                $container->make(Filesystem::class),
                $container->get('config')->get('schedule_doc.documentators.csv.separator')
            );
        });
    }
}
