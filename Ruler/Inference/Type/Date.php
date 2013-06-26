<?php

namespace Rezzza\RulerBundle\Ruler\Inference\Type;

/**
 * Date
 *
 * @uses InferenceType
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Date implements InferenceType
{
    /**
     * {@inheritdoc}
     */
    public function supports($key)
    {
        return $key === 'date';
    }
}
