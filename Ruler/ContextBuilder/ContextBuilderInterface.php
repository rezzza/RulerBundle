<?php

namespace Rezzza\RulerBundle\Ruler\ContextBuilder;

/**
 * ContextBuilderInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface ContextBuilderInterface
{
    /**
     * @return \Hoa\Ruler\Context
     */
    public function build();
}
