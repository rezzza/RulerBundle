<?php

namespace Rezzza\RulerBundle\Ruler\Inference\Type;

/**
 * Boolean
 *
 * @uses InferenceType
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Boolean implements InferenceType
{
    /**
     * {@inheritdoc}
     */
    public function supports($key)
    {
        return $key === 'boolean';
    }
}
