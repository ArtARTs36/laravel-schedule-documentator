<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Tests\Unit;

use ArtARTs36\LaravelScheduleDocumentator\Data\CommandData;
use ArtARTs36\LaravelScheduleDocumentator\Data\CronFrequency;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventData;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\CsvDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Tests\TestCase;

class CsvDocumentatorTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelScheduleDocumentator\Documentators\CsvDocumentator::getCsvContent
     */
    public function testGetCsvContent(): void
    {
        /** @var CsvDocumentator $documentator */
        $documentator = $this->app->make(CsvDocumentator::class);

        //

        $events = new EventCollection([
            new EventData(
                new CommandData($sign = 'test-command', $desc = 'test command description'),
                new CronFrequency($value = '* * * * *')
            )
        ]);

        $csv = $documentator->getCsvContent($events);

        self::assertEquals("command_signature;command_description;frequency_value;frequency_clear_name;
test-command;test command description;* * * * *;Every minute", $csv);
    }
}
