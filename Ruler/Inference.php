<?php

namespace Rezzza\RulerBundle\Ruler;

use Rezzza\RulerBundle\Ruler\Asserter\AsserterInterface;
use Rezzza\RulerBundle\Ruler\Exception\UnsupportedPropositionException;

/**
 * Inference
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Inference
{
    /**
     * @param mixed             $key         Define the key to get on context.
     * @param AsserterInterface $asserter    asserter
     * @param string            $description Descript the inference.
     */
    public function __construct($key, AsserterInterface $asserter, $description = null)
    {
        $this->key         = $key;
        $this->asserter    = $asserter;
        $this->description = $description;
    }

    /**
     * @param string $operator    ex: >=, =, !=
     * @param mixed  $value       compare to ?
     *
     * @return Proposition
     */
    public function createProposition($operator, $value)
    {
        return new Proposition($this->key, $this->asserter, $operator, $value);
    }
}
