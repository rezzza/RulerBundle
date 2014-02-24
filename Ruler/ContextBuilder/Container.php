<?php

namespace Rezzza\RulerBundle\Ruler\ContextBuilder;

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
    protected $contextBuilders = array();

    /**
     * @param string                  name             name
     * @param ContextBuilderInterface $contextBuilder contextBuilder
     */
    public function add($name, ContextBuilderInterface $contextBuilder)
    {
        $this->contextBuilders[$name] = $contextBuilder;
    }

    /**
     * @param string $key key
     *
     * @return ContextBuilderInterface|null
     */
    public function get($key)
    {
        return $this->has($key) ? $this->contextBuilders[$key] : null;
    }

    /**
     * @param string $key key
     *
     * @return boolean
     */
    public function has($key)
    {
        return isset($this->contextBuilders[$key]);
    }

    /**
     * @return new \ArrayIterator
     */
    public function all()
    {
        return $this->contextBuilders;
    }
}
