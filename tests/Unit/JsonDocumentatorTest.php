<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Tests\Unit;

use ArtARTs36\LaravelScheduleDocumentator\Data\CommandData;
use ArtARTs36\LaravelScheduleDocumentator\Data\CronFrequency;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventData;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\JsonDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Tests\TestCase;

class JsonDocumentatorTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelScheduleDocumentator\Documentators\JsonDocumentator::document
     */
    public function testEventsToArray(): void
    {
        /** @var JsonDocumentator $documentator */
        $documentator = $this->app->make(JsonDocumentator::class);

        //

        $events = new EventCollection([]);

        self::assertSame([
            'events' => [],
        ], $documentator->eventsToArray($events));

        //

        $events = new EventCollection([
            new EventData(
                new CommandData($sign = 'test-command', $desc = 'test command description'),
                new CronFrequency($value = '* * * * *')
            )
        ]);

        self::assertEquals([
            'events' => [
                [
                    'command' => [
                        'signature' => $sign,
                        'description' => $desc,
                    ],
                    'frequency' => [
                        'value' => $value,
                        'clear_name' => 'Every minute',
                    ],
                ],
            ],
        ], $documentator->eventsToArray($events));
    }
}
