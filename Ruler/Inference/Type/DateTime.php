<?php

namespace Rezzza\RulerBundle\Ruler\Inference\Type;

/**
 * DateTime
 *
 * @uses InferenceType
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class DateTime implements InferenceType
{
    /**
     * {@inheritdoc}
     */
    public function supports($key)
    {
        return $key === 'datetime';
    }
}
