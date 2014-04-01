<?php

namespace Rezzza\RulerBundle\Ruler\Visitor;

use Hoa\Ruler\Visitor\Asserter as BaseAsserter;
use Symfony\Component\PropertyAccess\PropertyAccess;

class Asserter extends BaseAsserter
{
    protected function visitContextAttribute($value, $out, $i, $id)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        return $accessor->getValue($out, $value);
    }
}
