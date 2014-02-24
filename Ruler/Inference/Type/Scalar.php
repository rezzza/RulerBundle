<?php

namespace Rezzza\RulerBundle\Ruler\Inference\Type;

/**
 * Scalar
 *
 * @uses InferenceType
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Scalar implements InferenceType
{
    /**
     * {@inheritdoc}
     */
    public function supports($key)
    {
        return $key === 'scalar';
    }
}
