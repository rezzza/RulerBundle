<?php

namespace Rezzza\RulerBundle\Ruler;

use Ruler\Proposition as PropositionInterface;
use Ruler\Operator\LogicalOperator;
use Rezzza\RulerBundle\Ruler\Proposition;
use Rezzza\RulerBundle\Ruler\Inference;
use Rezzza\RulerBundle\Ruler\Asserter\AsserterInterface;
use Rezzza\RulerBundle\Ruler\Exception\UnknownAsserterException;

/**
 * Factory
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Factory
{
    /**
     * @var AsserterContainer
     */
    private $asserters;

    /**
     * @param AsserterContainer $asserters asserters
     */
    public function __construct(AsserterContainer $asserters)
    {
        $this->asserters = $asserters;
    }

    /**
     * @param string $key         key
     * @param string $asserter    asserter
     * @param string $description description
     * @throws UnknownAsserterException if asserter is unknown.
     *
     * @return Inference
     */
    public function createInference($key, $asserter, $description = null)
    {
        if (!$this->asserters->has($asserter)) {
            throw new UnknownAsserterException(sprintf('Asserter "%s" does not exists or is not defined via a @tag.', $asserter));
        }

        return new Inference($key, $this->asserters->get($asserter), $description);
    }

    /**
     * @param PropositionInterface $proposition proposition
     */
    public function serialize(PropositionInterface $proposition)
    {
        // this is the only one format accepted at this moment.
        return serialize($proposition);
    }

    /**
     * @param string $data   data serialized.
     * @param string $format only linear is supported at this moment.
     *
     * @return Rule|null
     */
    public function deserialize($data, $format = 'linear')
    {
        $data = unserialize($data);
        $this->resetAsserter($data);

        return $data;
    }

    /**
     * Reset asserter during a deserialization.
     *
     * @param PropositionInterface $proposition proposition
     */
    protected function resetAsserter(PropositionInterface $proposition)
    {
        if ($proposition instanceof Proposition) {
            $ident = $proposition
                ->getAsserter()
                ->getIdent();

            $proposition->setAsserter($this->asserters->get($ident));
            return;
        } elseif ($proposition instanceof LogicalOperator) {
            $property = 'propositions';
        } else {
            $property = 'condition';
        }

        // @improve. poor, but at this moment no way to make it in an other way. Idea ?
        $reflection = new \ReflectionClass($proposition);
        $property   = $reflection->getProperty($property);
        $property->setAccessible(true);

        $conditions = $property->getValue($proposition);
        if (!is_array($conditions)) {
            $conditions = array($conditions);
        }

        foreach ($conditions as $condition) {
            $this->resetAsserter($condition);
        }
    }
}
