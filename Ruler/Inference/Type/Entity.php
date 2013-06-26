<?php

namespace Rezzza\RulerBundle\Ruler\Inference\Type;

/**
 * Entity
 *
 * @uses InferenceType
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Entity implements InferenceType
{
    /**
     * {@inheritdoc}
     */
    public function supports($key)
    {
        return strpos($key, 'entity') === 0;
    }
}
