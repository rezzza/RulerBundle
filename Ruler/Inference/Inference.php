<?php

namespace Rezzza\RulerBundle\Ruler\Inference;

/**
 * Inference
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Inference
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $events;

    /**
     * @param string $key         key
     * @param string $type        type
     * @param string $description description
     * @param array  $events      events
     */
    public function __construct($key, $type, $description, array $events = array())
    {
        $this->key         = $key;
        $this->type        = $type;
        $this->description = $description;
        $this->events      = $events;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
