<?php

namespace Rezzza\RulerBundle\Ruler;

use Rezzza\RulerBundle\Ruler\Inference;

/**
 * InferenceContainer
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class InferenceContainer
{
    /**
     * @var \ArrayIterator
     */
    protected $inferences;

    /**
     * Initialize inferences collection.
     */
    public function __construct()
    {
        $this->inferences = new \ArrayIterator();
    }

    /**
     * @param Inference $inference inference
     */
    public function add(Inference $inference)
    {
        $this->inferences->offsetSet($inference->getKey(), $inference);
    }

    /**
     * @param string $key key
     *
     * @return Inference|null
     */
    public function get($key)
    {
        return $this->has($key) ? $this->inferences[$key] : null;
    }

    /**
     * @param string $key key
     *
     * @return boolean
     */
    public function has($key)
    {
        return $this->inferences->offsetExists($key);
    }
}
