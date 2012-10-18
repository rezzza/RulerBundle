<?php

namespace Rezzza\RulerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;

/**
 * BuilderCompilerPass
 *
 * @uses CompilerPassInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class BuilderCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $factory            = $container->getDefinition('rezzza.ruler.factory');
        $asserterContainer  = $container->getDefinition('rezzza.ruler.asserter_container');
        $inferenceContainer = $container->getDefinition('rezzza.ruler.inference_container');

        foreach ($container->findTaggedServiceIds('rezzza.ruler.asserter') as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $asserter = $container->getDefinition($id);
                $asserter->addMethodCall('setIdent', array($attributes['id']));

                $asserterContainer->addMethodCall('add', array($asserter));
            }
        }

        $inferenceDatas = $container->getParameter('rezzza.ruler.inferences');

        foreach ($inferenceDatas as $key => $inferenceData) {
            $definition = new Definition();
            $definition->setFactoryService('rezzza.ruler.factory');
            $definition->setFactoryMethod('createInference');
            $definition->setArguments(array(
                $key, $inferenceData['type'], $inferenceData['description']
            ));

            $inferenceContainer->addMethodCall('add', array($definition));
        }
    }
}
