<?php

namespace Rezzza\RulerBundle\Ruler\Event;

use Rezzza\RulerBundle\Ruler\Inference\Inference;

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
    protected $label;

    /**
     * @var string
     */
    protected $contextBuilder;

    /**
     * @var array
     */
    protected $inferences = array();

    /**
     * @param string $key            key
     * @param string $label          label
     * @param string $contextBuilder contextBuilder
     */
    public function __construct($key, $label, $contextBuilder)
    {
        $this->key            = $key;
        $this->label          = $label;
        $this->contextBuilder = $contextBuilder;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getContextBuilder()
    {
        return $this->contextBuilder;
    }

    /**
     * @param Inference $inference inference
     */
    public function addInference(Inference $inference)
    {
        $this->inferences[] = $inference;
    }

    /**
     * @return array
     */
    public function getInferences()
    {
        return $this->inferences;
    }
}
