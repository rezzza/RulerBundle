<?php

namespace Rezzza\RulerBundle\Ruler\Inference\Type;

/**
 * InferenceType
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface InferenceType
{
    /**
     * @param string $key key
     *
     * @return boolean
     */
    public function supports($key);
}
