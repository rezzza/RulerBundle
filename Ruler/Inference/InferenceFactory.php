<?php

namespace Rezzza\RulerBundle\Ruler\Inference;

use Rezzza\RulerBundle\Ruler\Inference;
use Rezzza\RulerBundle\Ruler\Asserter\AsserterInterface;
use Rezzza\RulerBundle\Ruler\Exception\UnknownAsserterException;

/**
 * InferenceFactory
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class InferenceFactory
{
    /**
     * @var array<AsserterInterface>
     */
    protected $asserters = array();

    /**
     * @param string $key         key
     * @param string $asserter    asserter
     * @param string $description description
     * @throws UnknownAsserterException if asserter is unknown.
     *
     * @return Inference
     */
    public function create($key, $asserter, $description = null)
    {
        if (!array_key_exists($asserter, $this->asserters)) {
            throw new UnknownAsserterException(sprintf('Asserter "%s" does not exists or is not defined via a @tag.', $asserter));
        }

        return new Inference($key, $this->asserters[$asserter], $description);
    }

    /**
     * @param string            $key      identifier of asserter
     * @param AsserterInterface $asserter asserter
     */
    public function addAsserter($key, AsserterInterface $asserter)
    {
        $this->asserters[$key] = $asserter;
    }
}
