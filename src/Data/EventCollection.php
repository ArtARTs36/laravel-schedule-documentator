<?php

namespace ArtARTs36\LaravelScheduleDocumentator\Data;

class EventCollection implements \IteratorAggregate, \Countable
{
    protected $events;

    /**
     * @param array<EventData> $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;
    }

    public function first(): ?EventData
    {
        return $this->events[array_key_first($this->events)];
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->events);
    }

    public function count()
    {
        return count($this->events);
    }
}
