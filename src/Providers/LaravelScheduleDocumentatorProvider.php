<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Providers;

use ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory;
use Illuminate\Support\ServiceProvider;

class LaravelScheduleDocumentatorProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/schedule_doc.php', 'schedule_doc');

        if ($this->app->runningInConsole()) {
            $this->publishSelfPackage();
        }

        $this->registerDocumentatorFactory();
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
            return new DocumentatorFactory($this->app, config('schedule_doc.documentators'));
        });
    }
}
