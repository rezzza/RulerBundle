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
        $this->bindOperators(array(
            '=', '!=',
            '>', '>=', '<', '<='
        ));
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
