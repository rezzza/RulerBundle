<?php

namespace Rezzza\RulerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;

/**
 * InferenceBuilderCompilerPass
 *
 * @uses CompilerPassInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class InferenceBuilderCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $factory            = $container->getDefinition('rezzza.ruler.inference_factory');
        $inferenceContainer = $container->getDefinition('rezzza.ruler.inference_container');

        foreach ($container->findTaggedServiceIds('rezzza.ruler.asserter') as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $factory->addMethodCall('addAsserter', array($attributes['id'], new Reference($id)));
            }
        }

        $inferenceDatas = $container->getParameter('rezzza.ruler.inferences');

        foreach ($inferenceDatas as $key => $inferenceData) {
            $definition = new Definition();
            $definition->setFactoryService('rezzza.ruler.inference_factory');
            $definition->setFactoryMethod('create');
            $definition->setArguments(array(
                $key, $inferenceData['type'], $inferenceData['description']
            ));

            $inferenceContainer->addMethodCall('add', array($definition));
        }
    }
}
