<?php

namespace Rezzza\RulerBundle\Ruler\Asserter;

use Rezzza\RulerBundle\Ruler\Proposition;
use Ruler\Context;
use Rezzza\RulerBundle\Ruler\Exception\ContextValueNotFoundException;
use Rezzza\RulerBundle\Ruler\Exception\OperatorNotFoundException;

/**
 * AbstractAsserter
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
abstract class AbstractAsserter
{
    protected $operators;

    /**
     * Add some operators
     */
    public function __construct()
    {
        $this->operators       = new \ArrayIterator();
        $this->operators['=']  = function ($a, $b) { return $a == $b; };
        $this->operators['!='] = function ($a, $b) { return $a != $b; };
    }

    /**
     * {@inheritdoc}
     */
    public function supportsProposition(Proposition $proposition)
    {
        return $this->operators->offsetExists($proposition->getOperator());
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(Proposition $proposition, Context $context)
    {
        $key      = $proposition->getKey();

        if (!isset($context[$key])) {
            throw new ContextValueNotFoundException(sprintf('Key "%s" not found on context', $key));
        }

        $operator = $proposition->getOperator();

         if (!$this->operators->offsetExists($operator)) {
             throw new OperatorNotFoundException('Operator "%s" does no exists', $operator);
         }

        $callable = $this->operators->offsetGet($operator);

        $left  = $this->prepareValue($proposition->getValue());
        $right = $this->prepareValue($context[$key]);

        if (!is_callable($callable)) {
            throw new \LogicException('Operator "%s" provides a non callable value', $operator);
        }

        if ($callable instanceof \Closure) {
            $value = $callable($left, $right);
        } else {
            $value = call_user_func_array($callable, array($left, $right));
        }

        return $value;
    }

    /**
     * @param string $value value
     *
     * @return string
     */
    public function prepareValue($value)
    {
        return $value;
    }
}
