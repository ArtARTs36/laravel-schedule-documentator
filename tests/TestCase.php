<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Tests;

use ArtARTs36\LaravelScheduleDocumentator\Providers\LaravelScheduleDocumentatorProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelScheduleDocumentatorProvider::class,
        ];
    }
}
