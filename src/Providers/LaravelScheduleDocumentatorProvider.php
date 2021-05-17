<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Providers;

use ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\MarkdownDocumentator;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;

class LaravelScheduleDocumentatorProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/schedule_doc.php', 'schedule_doc');

        if ($this->app->runningInConsole()) {
            $this->publishSelfPackage();
        }

        $this->registerDocumentatorFactory();
        $this->registerMarkdownDocumentator();

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
}
