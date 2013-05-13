<?php

namespace Rezzza\RulerBundle\Ruler\Asserter;

use Rezzza\RulerBundle\Ruler\Proposition;
use Ruler\Context;

/**
 * Version
 *
 * @uses AbstractAsserter
 * @uses AsserterInterface
 * @author Sébastien HOUZÉ <s@verylastroom.com>
 */
class Version extends AbstractAsserter implements AsserterInterface
{
    public function __construct()
    {
        $operators = array(
            '<>', '!=', '=', '==', '<=', '<', '>=', '>'
        );

        $versionCompareCallable = function($operator) {
            return function ($a, $b) use ($operator) {
                return version_compare($a, $b, $operator);
            };
        };

        $this->bindOperators($operators);

        foreach ($operators as $operator) {
            $this->operators[$operator] = $versionCompareCallable($operator);
        }
    }
}
