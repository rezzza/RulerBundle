<?php

namespace Rezzza\RulerBundle\Ruler\Event;

/**
 * Container
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Container
{
    /**
     * @var array
     */
    protected $events = array();

    /**
     * @param Event $event event
     */
    public function add(Event $event)
    {
        $this->events[$event->getKey()] = $event;
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
        return isset($this->events[$key]);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->events;
    }
}
