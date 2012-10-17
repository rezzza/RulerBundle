<?php

namespace Rezzza\RulerBundle\Tests\Units\Ruler\Asserter;

require_once __DIR__ . '/../../../../vendor/autoload.php';

class DateTime extends AbstractAsserter
{
    public function getAsserter()
    {
        return new \Rezzza\RulerBundle\Ruler\Asserter\Datetime();
    }

    public function supportsPropositionDataProvider()
    {
        return array(
            array('=', 'now', true),
            array('=', '+1 day', true),
            array('=', 'chuck testa', false), // chuck testa is not a valid date :o
            array('!=', '2011-06-10 11:30:00', true),
            array('>=', '2011-06-10 11:30:00', true),
            array('>', '2011-06-10 11:30:00', true),
            array('<=', '2011-06-10 11:30:00', true),
            array('<', '2011-06-10 11:30:00', true),
        );
    }

    public function evaluateDataProvider()
    {
        return array(
            array('now', '=', 'now', true),
            array('now', '!=', 'now', false),
            array('now', '<=', 'tomorrow', true),
            array('now + 2 days', '<', 'tomorrow', false),
            array('now', '>', 'tomorrow', false),
            array('now + 2 days', '>', 'tomorrow', true),
            array('2011-06-10 11:30:00', '=', '2011-06-10 11:30:00', true),
            array('2011-06-10 11:30:00', '=', '2011-06-10 23:30:00', false), // we check for a datetime.
        );
    }
}
