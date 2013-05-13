<?php

namespace Rezzza\RulerBundle\Tests\Units\Ruler\Asserter;

require_once __DIR__ . '/../../../../vendor/autoload.php';

class Version extends AbstractAsserter
{
    public function getAsserter()
    {
        return new \Rezzza\RulerBundle\Ruler\Asserter\Version();
    }

    public function supportsPropositionDataProvider()
    {
        return array(
            array('<>', '1.2.0', true),
            array('!=', '1.2.0', true),
            array('=', '1.2.0', true),
            array('==', '1.2.0', true),
            array('<=', '1.2.0', true),
            array('<', '1.2.0', true),
            array('>=', '1.2.0', true),
            array('~=', '1.2.0', false),
        );
    }

    public function evaluateDataProvider()
    {
        return array(
            array('1.0.0', '!=', '1.0.1', true),
            array('1.0.0', '<>', '1.0.1', true),
            array('1.0.1', '!=', '1.0.1', false),
            array('1.0.1', '<>', '1.0.1', false),

            array('1.0.0', '=', '1.0.1', false),
            array('1.0.0', '==', '1.0.1', false),
            array('1.0.1', '=', '1.0.1', true),
            array('1.0.1', '==', '1.0.1', true),

            array('1.0.0', '<=', '1.0.1', true),
            array('1.0.1', '<=', '1.0.1', true),
            array('1.0.1', '<=', '1.0.0', false),

            array('1.0.0', '<', '1.0.1', true),
            array('1.0.1', '<', '1.0.1', false),
            array('1.0.1', '<', '1.0.0', false),

            array('1.0.0', '>=', '1.0.1', false),
            array('1.0.1', '>=', '1.0.1', true),
            array('1.0.1', '>=', '1.0.0', true),

            array('1.0.0', '>', '1.0.1', false),
            array('1.0.1', '>', '1.0.1', false),
            array('1.0.1', '>', '1.0.0', true),

            array('2', '==', '2', true),
            array('1.0RC1', '==', '1.0RC1', true),
            array('1.0-b2', '==', '1.0-b2', true),
            array('1.0.0-alpha1', '<', '1.0.0-b1', true),
            array('1.0.0-b1', '<', '1.0.0-rc1', true),
            array('1.0.0-rc1', '<', '1.0.0', true),
            array('1.0.0-rc2', '>', '1.0.0-rc1', true),
        );
    }
}
