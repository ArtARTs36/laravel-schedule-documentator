<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Tests\Unit;

use ArtARTs36\LaravelScheduleDocumentator\Data\CommandData;
use ArtARTs36\LaravelScheduleDocumentator\Data\CronFrequency;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventCollection;
use ArtARTs36\LaravelScheduleDocumentator\Data\EventData;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\MarkdownDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Tests\TestCase;

class MarkdownDocumentatorTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelScheduleDocumentator\Documentators\MarkdownDocumentator::getMarkdown
     */
    public function testGetMarkdown(): void
    {
        /** @var MarkdownDocumentator $documentator */
        $documentator = $this->app->make(MarkdownDocumentator::class);

        //

        $events = new EventCollection([
            new EventData(
                new CommandData($sign = 'test-command', $desc = 'test command description'),
                new CronFrequency($value = '* * * * *')
            )
        ]);

        $result = $documentator->getMarkdown($events);

        self::assertEquals("## App Console Schedule

|  Command Description  | Command Signature  | Frequency |
| ------------ | ------------ | ------------ |

| test command description  | test-command  | Every minute (* * * * *)  |\n", $result);
    }
}
