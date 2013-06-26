<?php

namespace Rezzza\RulerBundle\Ruler;

/**
 * FunctionCollectionInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface FunctionCollectionInterface
{
    /**
     * @return array(function_name => \Closure);
     */
    public function getFunctions();
}
