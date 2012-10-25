<?php

namespace Rezzza\RulerBundle\Tests\Units\Ruler\Asserter;

require_once __DIR__ . '/../../../../vendor/autoload.php';

use Rezzza\RulerBundle\Tests\Units\Test;
use Ruler\Context;

abstract class AbstractAsserter extends Test
{
    abstract public function getAsserter();

    private $mockProposition;

    /**
     * @dataProvider supportsPropositionDataProvider
     */
    public function testSupportsProposition($operator, $value, $expectedSupport)
    {
        $proposition = $this->getMockProposition();
        $proposition->getMockController()->getOperator = $operator;
        $proposition->getMockController()->getValue    = $value;

        $asserter = $this->getAsserter();

        $this->boolean($asserter->supportsProposition($proposition))
            ->isIdenticalTo($expectedSupport);
    }

    /**
     * @dataProvider evaluateDataProvider
     */
    public function testEvaluate($contextValue, $operator, $definedValue, $expectedEvaluate)
    {
        $proposition = $this->getMockProposition();
        $proposition->getMockController()->getOperator = $operator;
        $proposition->getMockController()->getValue    = $definedValue;
        $proposition->getMockController()->getKey      = 'key';

        $context = new Context();
        $context['key'] = $contextValue;

        $asserter = $this->getAsserter();

        $this->boolean($asserter->evaluate($proposition, $context))
            ->isIdenticalTo($expectedEvaluate);
    }

    private function getMockProposition()
    {
        if (!$this->mockProposition) {
            $this->mockGenerator()->orphanize('__construct');
            $this->mockClass('\Rezzza\RulerBundle\Ruler\Proposition', '\Mock');

            $this->mockProposition = new \Mock\Proposition();
        }

        return $this->mockProposition;
    }
}
