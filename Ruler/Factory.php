<?php

namespace Rezzza\RulerBundle\Ruler;

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
}
