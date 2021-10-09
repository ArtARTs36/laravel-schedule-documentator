<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Tests\Unit;

use ArtARTs36\LaravelScheduleDocumentator\Services\FromKernelDataFetcher;
use ArtARTs36\LaravelScheduleDocumentator\Services\ScheduleAdapter;
use ArtARTs36\LaravelScheduleDocumentator\Tests\TestCase;

class FromKernelDataFetcherTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelScheduleDocumentator\Services\FromKernelDataFetcher::fetch
     */
    public function testFetch(): void
    {
        /** @var FromKernelDataFetcher $fetcher */
        $fetcher = $this->app->make(FromKernelDataFetcher::class);

        // Empty Schedule

        /** @var ScheduleAdapter $schedule */
        $schedule = $this->app->make(ScheduleAdapter::class);

        self::assertCount(0, $fetcher->fetch($schedule));

        //

        $schedule->getSchedule()->command('cache:clear')->dailyAt('12:00');

        $events = $fetcher->fetch($schedule);

        self::assertCount(1, $events);

        $event = $events->first();

        self::assertEquals('Flush the application cache', $event->command->description);
        self::assertStringContainsString('cache:clear', $event->command->signature);
    }
}
