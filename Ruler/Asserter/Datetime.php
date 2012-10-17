<?php

namespace Rezzza\RulerBundle\Ruler\Asserter;

use Rezzza\RulerBundle\Ruler\Proposition;
use Ruler\Context;

/**
 * Datetime
 *
 * @uses AbstractAsserter
 * @uses AsserterInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Datetime extends AbstractAsserter implements AsserterInterface
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

        try {
            $value = $proposition->getValue();
            if ($value instanceof \DateTime) {
                return true;
            }

            $date = new \DateTime($value);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function prepareValue($value)
    {
        if (!$value instanceof \DateTime) {
            $value = new \DateTime($value);
        }

        return $value;
    }
}
