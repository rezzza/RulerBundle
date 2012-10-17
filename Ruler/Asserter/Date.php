<?php

namespace Rezzza\RulerBundle\Ruler\Asserter;

use Rezzza\RulerBundle\Ruler\Proposition;
use Ruler\Context;

/**
 * Date
 *
 * @uses AbstractAsserter
 * @uses AsserterInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Date extends DateTime implements AsserterInterface
{
    /**
     * {@inheritdoc}
     */
    public function prepareValue($value)
    {
        $value = parent::prepareValue($value);
        $value->modify('00:00:00'); // we compare a DATE ! not a datetime.

        return $value;
    }
}
