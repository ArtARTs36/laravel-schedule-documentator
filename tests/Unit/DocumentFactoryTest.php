<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Tests\Unit;

use ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory;
use ArtARTs36\LaravelScheduleDocumentator\Documentators\JsonDocumentator;
use ArtARTs36\LaravelScheduleDocumentator\Exceptions\DocumentatorNotFound;
use ArtARTs36\LaravelScheduleDocumentator\Tests\TestCase;

class DocumentFactoryTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory::factory
     */
    public function testFactoryGood(): void
    {
        /** @var DocumentatorFactory $factory */
        $factory = $this->app->make(DocumentatorFactory::class, [
            'dict' => [
                'json' => JsonDocumentator::class,
            ],
        ]);

        self::assertInstanceOf(JsonDocumentator::class, $factory->factory('json'));
    }

    /**
     * @covers \ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory::factory
     */
    public function testFactoryBad(): void
    {
        /** @var DocumentatorFactory $factory */
        $factory = $this->app->make(DocumentatorFactory::class, [
            'dict' => [
                'json' => JsonDocumentator::class,
            ],
        ]);

        self::expectException(DocumentatorNotFound::class);

        $factory->factory('xml');
    }

    /**
     * @covers \ArtARTs36\LaravelScheduleDocumentator\Documentators\DocumentatorFactory::has
     */
    public function testHas(): void
    {
        /** @var DocumentatorFactory $factory */
        $factory = $this->app->make(DocumentatorFactory::class, [
            'dict' => [
                'json' => JsonDocumentator::class,
            ],
        ]);

        self::assertTrue($factory->has('json'));
        self::assertFalse($factory->has('xml'));
    }
}
