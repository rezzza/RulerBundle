<?php

namespace Rezzza\RulerBundle\Ruler\Asserter;

use Rezzza\RulerBundle\Ruler\Proposition;
use Ruler\Context;

/**
 * Decimal
 *
 * @uses AbstractAsserter
 * @uses AsserterInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Decimal extends AbstractAsserter implements AsserterInterface
{
    public function __construct()
    {
        parent::__construct();

        $this->operators['>']  = function ($a, $b) { return $a > $b; };
        $this->operators['>=']  = function ($a, $b) { return $a >= $b; };
        $this->operators['<']  = function ($a, $b) { return $a < $b; };
        $this->operators['<=']  = function ($a, $b) { return $a <= $b; };
    }

    /**
     * {@inheritdoc}
     */
    public function supportsProposition(Proposition $proposition)
    {
        if (!parent::supportsProposition($proposition)) {
            return false;
        }

        return is_numeric($proposition->getValue());
    }
}
