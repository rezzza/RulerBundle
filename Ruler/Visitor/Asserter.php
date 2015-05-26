<?php

namespace Rezzza\RulerBundle\Ruler\Visitor;

use Hoa\Ruler\Visitor\Asserter as BaseAsserter;
use Symfony\Component\PropertyAccess\PropertyAccess;

class Asserter extends BaseAsserter
{
    protected function visitContextAttribute(&$contextPointer, array $dimension, $dimensionNumber, $elementId, &$handle = null, $eldnah = null)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        return $accessor->getValue($contextPointer, $dimension[$dimensionNumber]);
    }
}
