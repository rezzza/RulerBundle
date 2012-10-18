<?php

namespace Rezzza\RulerBundle\Ruler\Asserter;

/**
 * Boolean
 *
 * @uses AbstractAsserter
 * @uses AsserterInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Boolean extends AbstractAsserter implements AsserterInterface
{
    public function __construct()
    {
        $this->bindOperators(array(
            '=', '!=',
        ));
    }
}
