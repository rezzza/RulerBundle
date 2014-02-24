<?php

namespace Rezzza\RulerBundle\Ruler\Inference\Type;

/**
 * Decimal
 *
 * @uses InferenceType
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Decimal implements InferenceType
{
    /**
     * {@inheritdoc}
     */
    public function supports($key)
    {
        return $key === 'decimal';
    }
}
