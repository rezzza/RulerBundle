<?php

namespace Rezzza\RulerBundle\Ruler\Asserter;

use Rezzza\RulerBundle\Ruler\Proposition;
use Ruler\Context;

/**
 * String
 *
 * @uses AbstractAsserter
 * @uses AsserterInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class String extends AbstractAsserter implements AsserterInterface
{
    public function __construct()
    {
        $this->bindOperators(array(
            '=', '!=',
        ));
    }

}
