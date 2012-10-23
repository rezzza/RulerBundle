<?php

namespace Rezzza\RulerBundle\Ruler;

use Rezzza\RulerBundle\Ruler\Event;

/**
 * EventContainer
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class EventContainer
{
    /**
     * @var \ArrayIterator
     */
    protected $events;

    /**
     * Initialize events collection.
     */
    public function __construct()
    {
        $this->events = new \ArrayIterator();
    }

    /**
     * @param Event $event event
     */
    public function add(Event $event)
    {
        $this->events->offsetSet($event->getKey(), $event);
    }

    /**
     * @param string $key key
     *
     * @return Event|null
     */
    public function get($key)
    {
        return $this->has($key) ? $this->events[$key] : null;
    }

    /**
     * @param string $key key
     *
     * @return boolean
     */
    public function has($key)
    {
        return $this->events->offsetExists($key);
    }
}
