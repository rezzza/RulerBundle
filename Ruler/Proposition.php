<?php

namespace Rezzza\RulerBundle\Ruler;

use Ruler\Proposition as PropositionInterface;
use Ruler\Context;
use Ruler\Variable;
use Ruler\Value;
use Rezzza\RulerBundle\Ruler\Asserter\AsserterInterface;
use Rezzza\RulerBundle\Ruler\Exception\UnsupportedPropositionException;

/**
 * Proposition
 *
 * @uses PropositionInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Proposition implements PropositionInterface
{
    protected $key;
    protected $asserter;
    protected $operator;
    protected $value;

    /**
     * @param string            $key         Define the key to get on context.
     * @param AsserterInterface $asserter    asserter
     * @param mixed             $operator    ex: >=, =, !=
     * @param mixed             $value       compare to ?
     *
     * @return void
     */
    public function __construct($key, AsserterInterface $asserter, $operator, $value)
    {
        $this->key      = $key;
        $this->operator = $operator;
        $this->value    = $value;

        if (!$asserter->supportsProposition($this)) {
            throw new UnsupportedPropositionException(sprintf('Operator "%s" or value is not supported by asserter "%s"', $operator, get_class($asserter)));
        }

        $this->asserter = $asserter;
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(Context $context)
    {
        return $this->asserter->evaluate($this, $context);
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
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return AsserterInterface
     */
    public function getAsserter()
    {
        return $this->asserter;
    }

    /**
     * @param AsserterInterface $asserter asserter
     */
    public function setAsserter(AsserterInterface $asserter)
    {
        $this->asserter = $asserter;
    }
}
