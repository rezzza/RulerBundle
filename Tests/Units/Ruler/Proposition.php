<?php

namespace Rezzza\RulerBundle\Tests\Units\Ruler;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Rezzza\RulerBundle\Tests\Units\Test;

use Rezzza\RulerBundle\Ruler\Proposition as PropositionObject;
use Ruler\Context;
use Ruler\Rule;
use Ruler\Operator;

class Proposition extends Test
{
    public function testConstructor()
    {
        $this->if($this->mockClass('Rezzza\RulerBundle\Ruler\Asserter\AsserterInterface', '\Mock', 'Asserter'))
            ->and($asserter = new \Mock\Asserter())
            ->and($asserter->getMockController()->supportsProposition = false)
            ->exception(function() use ($asserter) {
                $proposition = new PropositionObject('key', $asserter, 'operator', true);
            })
                ->isInstanceOf('\Rezzza\RulerBundle\Ruler\Exception\UnsupportedPropositionException')
                ->hasMessage('Operator "operator" or value is not supported by asserter "Mock\Asserter"')
            ->and($asserter->getMockController()->supportsProposition = true)
            ->and($proposition = new PropositionObject('key', $asserter, 'operator', true))
            ->string($proposition->getKey())
                ->isEqualTo('key')
            ->string($proposition->getOperator())
                ->isEqualTo('operator')
            ->boolean($proposition->getValue())
                ->isEqualTo(true)
            ;
    }

    public function testEvaluate()
    {
        $this->if($this->mockClass('Rezzza\RulerBundle\Ruler\Asserter\AsserterInterface', '\Mock', 'Asserter'))
            ->and($asserter = new \Mock\Asserter())
            ->and($asserter->getMockController()->supportsProposition = true)
            ->and($asserter->getMockController()->evaluate = false)
            ->and($proposition = new PropositionObject('key', $asserter, 'operator', '1234'))
            ->and($context = new Context())
            // evaluate proposition.
            ->boolean($proposition->evaluate($context))
                ->isFalse()
            ->mock($asserter)
                ->call('evaluate')
                ->withArguments($proposition, $context)
                ->once()
            ->and($asserter->getMockController()->evaluate = true)
            ->boolean($proposition->evaluate($context))
                ->isTrue()
            ->mock($asserter)
                ->call('evaluate')
                ->withArguments($proposition, $context)
                ->exactly(2)
            ;
    }

    public function testLogicalOperators()
    {
        $this->mockClass('Rezzza\RulerBundle\Ruler\Asserter\AsserterInterface', '\Mock', 'Asserter');

        // proposition 1 (TRUE)
        $asserter = new \Mock\Asserter();
        $asserter->getMockController()->supportsProposition = true;
        $asserter->getMockController()->evaluate = true;
        $proposition1 = new PropositionObject('key', $asserter, 'operator', '1234');

        // proposition 2 (FALSE)
        $asserter2 = new \Mock\Asserter();
        $asserter2->getMockController()->supportsProposition = true;
        $asserter2->getMockController()->evaluate = false;
        $proposition2 = new PropositionObject('key2', $asserter2, 'operator', '1234');

        $rule = new Rule(
            new Operator\LogicalAnd(array(
                $proposition1,
                $proposition2
            ))
        );

        $this->boolean($rule->evaluate(new Context()))
            ->isFalse();

        $rule = new Rule(
            new Operator\LogicalOr(array(
                $proposition1,
                $proposition2
            ))
        );

        $this->boolean($rule->evaluate(new Context()))
            ->isTrue();

        $rule = new Rule(
            new Operator\LogicalAnd(array(
                $proposition1,
                new Operator\LogicalOr(array(
                    $proposition1,
                    $proposition2,
                ))
            ))
        );

        $this->boolean($rule->evaluate(new Context()))
            ->isTrue();
    }
}
