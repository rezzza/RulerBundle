<?php

namespace Rezzza\RulerBundle\Tests\Units\Ruler\Asserter;

require_once __DIR__ . '/../../../../vendor/autoload.php';

class Boolean extends AbstractAsserter
{
    public function getAsserter()
    {
        return new \Rezzza\RulerBundle\Ruler\Asserter\Boolean();
    }

    public function supportsPropositionDataProvider()
    {
        // 2nd parameter is value, we don't care.
        return array(
            array('=', null, true),
            array('!=', null, true),
            array('>=', null, false),
            array('>', null, false),
            array('<=', null, false),
            array('<', null, false),
        );
    }

    public function evaluateDataProvider()
    {
        return array(
            // same left & right
            array(true, '=', true, true),
            array(true, '!=', true, false),
            array(false, '=', false, true),
            array(false, '!=', false, false),
            // differ
            array(true, '=', false, false),
            array(true, '!=', false, true),
            array(false, '=', true, false),
            array(false, '!=', true, true),
        );
    }
}
