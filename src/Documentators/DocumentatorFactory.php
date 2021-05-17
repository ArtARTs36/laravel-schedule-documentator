<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Documentators;

use ArtARTs36\LaravelScheduleDocumentator\Contracts\Documentator;
use ArtARTs36\LaravelScheduleDocumentator\Exceptions\DocumentatorNotFound;
use Illuminate\Contracts\Container\Container;

class DocumentatorFactory
{
    protected $container;

    protected $dict;

    public function __construct(Container $container, array $dict)
    {
        $this->container = $container;
        $this->dict = $dict;
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \ArtARTs36\LaravelScheduleDocumentator\Exceptions\DocumentatorNotFound
     */
    public function factory(string $ext): Documentator
    {
        if (! $this->has($ext)) {
            throw new DocumentatorNotFound($ext);
        }

        return $this->container->make($this->dict[$ext]);
    }

    public function has(string $ext): bool
    {
        return array_key_exists($ext, $this->dict);
    }
}
