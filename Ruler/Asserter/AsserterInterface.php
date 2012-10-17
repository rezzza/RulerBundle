<?php

namespace Rezzza\RulerBundle\Ruler\Asserter;

use Ruler\Context;
use Rezzza\RulerBundle\Ruler\Proposition;

/**
 * AsserterInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface AsserterInterface
{
    /**
     * Is this asserter supports this proposition ?
     * It'll look at operator (>=, =, etc...) and may be value to
     * filter the type.
     *
     * @param Proposition $proposition proposition
     *
     * @return boolean
     */
    public function supportsProposition(Proposition $proposition);

    /**
     * Evaluate the proposition.
     *
     * @param Proposition $proposition proposition
     * @param Context     $context     context
     *
     * @return boolean
     */
    public function evaluate(Proposition $proposition, Context $context);
}
