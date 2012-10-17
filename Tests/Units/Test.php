<?php

namespace Rezzza\RulerBundle\Tests\Units;

use mageekguy\atoum;

/**
 * Test
 *
 * @uses atoum
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Test extends atoum\test
{
    /**
     * @param atoum\factory $factory factory
     */
    public function __construct(atoum\factory $factory = null)
    {
       $this->setTestNamespace('Tests\Units');
       parent::__construct($factory);
    }
}
