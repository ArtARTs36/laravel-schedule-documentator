<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Tests\Feature;

use ArtARTs36\LaravelScheduleDocumentator\Console\Commands\GenerateDocCommand;
use ArtARTs36\LaravelScheduleDocumentator\Tests\TestCase;

final class GenerateDocCommandTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelScheduleDocumentator\Console\Commands\GenerateDocCommand::handle
     */
    public function testHandle(): void
    {
        $this
            ->artisan(GenerateDocCommand::class, [
                'format' => 'md',
                'path' => 'schedule.md',
            ])
            ->assertSuccessful();

        self::assertFileExists('schedule.md');
    }
}
