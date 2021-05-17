<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Tests\Unit;

use ArtARTs36\LaravelScheduleDocumentator\Services\FromApplicationDataFetcher;
use ArtARTs36\LaravelScheduleDocumentator\Services\ScheduleAdapter;
use ArtARTs36\LaravelScheduleDocumentator\Tests\TestCase;
use Illuminate\Console\Application;

class FromApplicationDataFetcherTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelScheduleDocumentator\Services\FromApplicationDataFetcher::fetch
     */
    public function testFetch(): void
    {
        /** @var FromApplicationDataFetcher $fetcher */
        $fetcher = $this->app->make(FromApplicationDataFetcher::class, [
            'app' =>
                /** @var Application $app */
                $this->app->make(Application::class, [
                    'version' => '1.0.0',
                ])
        ]);

        // Empty Schedule

        self::assertCount(0, $fetcher->fetch($schedule = new ScheduleAdapter()));

        //

        $schedule->command('cache:clear')->dailyAt('12:00');

        $events = $fetcher->fetch($schedule);

        self::assertCount(1, $events);

        $event = $events->first();

        self::assertEquals('Flush the application cache', $event->command->description);
        self::assertContains('cache:clear', $event->command->signature);
    }
}
