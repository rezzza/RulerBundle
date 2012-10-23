<?php

namespace Rezzza\RulerBundle\Ruler;

use Rezzza\RulerBundle\Ruler\Asserter\AsserterInterface;
use Rezzza\RulerBundle\Ruler\Exception\UnsupportedPropositionException;

/**
 * Event
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Event
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $inferences = array();

    /**
     * @param mixed             $key         Define the key to get on context.
     * @param string            $description Descript the event.
     */
    public function __construct($key, $description = null)
    {
        $this->key         = $key;
        $this->description = $description;
    }

    /**
     * @param Inference $inference inference
     */
    public function addInference(Inference $inference)
    {
        $this->inferences[$inference->getKey()] = $inference;
    }

    /**
     * @return array
     */
    public function getInferences()
    {
        return $this->inferences;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
