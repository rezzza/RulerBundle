<?php

namespace Rezzza\RulerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Rezzza\RulerBundle\DependencyInjection\Compiler\BuilderCompilerPass;

/**
 * RezzzaRulerBundle
 *
 * @uses Bundle
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class RezzzaRulerBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new BuilderCompilerPass());
    }

}
