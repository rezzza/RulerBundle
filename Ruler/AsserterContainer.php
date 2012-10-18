<?php

namespace Rezzza\RulerBundle\Ruler;

use Rezzza\RulerBundle\Ruler\Asserter\AsserterInterface;

/**
 * AsserterContainer
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class AsserterContainer
{
    /**
     * @var \ArrayIterator
     */
    protected $asserters;

    /**
     * Initialize asserters collection.
     */
    public function __construct()
    {
        $this->asserters = new \ArrayIterator();
    }

    /**
     * @param AsserterInterface $asserter asserter
     */
    public function add(AsserterInterface $asserter)
    {
        $this->asserters->offsetSet($asserter->getIdent(), $asserter);
    }

    /**
     * @param string $key key
     *
     * @return Asserter|null
     */
    public function get($key)
    {
        return $this->has($key) ? $this->asserters[$key] : null;
    }

    /**
     * @param string $key key
     *
     * @return boolean
     */
    public function has($key)
    {
        return $this->asserters->offsetExists($key);
    }
}
