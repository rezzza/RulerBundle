<?php

namespace Rezzza\RulerBundle\Ruler\Inference;

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
    protected $inferences = array();

    /**
     * @param Inference $inference inference
     */
    public function add(Inference $inference)
    {
        $this->inferences[$inference->getKey()] = $inference;
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
        return isset($this->inferences[$key]);
    }
}
