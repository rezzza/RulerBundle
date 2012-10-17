<?php

namespace Rezzza\RulerBundle\Tests\Units\Ruler\Asserter;

require_once __DIR__ . '/../../../../vendor/autoload.php';

class Decimal extends AbstractAsserter
{
    public function getAsserter()
    {
        return new \Rezzza\RulerBundle\Ruler\Asserter\Decimal();
    }

    public function supportsPropositionDataProvider()
    {
        return array(
            array('=', '1', true),
            array('=', 'day', false),
            array('!=', '1.34', true),
            array('>=', '1.5e34', true),
            array('>', '3', true),
            array('<=', '1983103801931', true),
            array('<', '1337', true),
        );
    }

    public function evaluateDataProvider()
    {
        return array(
            array('1', '=', '1', true),
            array('1', '!=', '1', false),
            array('1', '>=', '1', true),
            array('1', '>', '1', false),
            array('2', '>', '1', true),
            // etc ...
        );
    }
}
