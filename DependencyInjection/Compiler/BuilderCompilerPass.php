<?php

namespace Rezzza\RulerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;
use Rezzza\RulerBundle\Ruler\Event;
use Rezzza\RulerBundle\Ruler\FunctionCollectionInterface;

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
        // add inference types
        $inferenceTypeContainer = $container->getDefinition('rezzza.ruler.inference_type_container');

        foreach ($container->findTaggedServiceIds('rezzza.ruler.inference_type') as $id => $tagAttributes) {
            $inferenceTypeContainer->addMethodCall('add', array(new Reference($id)));
        }

        // add events
        $eventDatas     = $container->getParameter('rezzza.ruler.events');
        $eventContainer = $container->getDefinition('rezzza.ruler.event.container');
        $events         = array();

        foreach ($eventDatas as $key => $data) {
            $event = new Definition('Rezzza\RulerBundle\Ruler\Event\Event', array(
                $key, $data['label'], $data['context_builder']
            ));

            $events[$key] = $event;

            $eventContainer->addMethodCall('add', array($event));
        }

        // add inferences
        $inferenceDatas     = $container->getParameter('rezzza.ruler.inferences');
        $inferenceContainer = $container->getDefinition('rezzza.ruler.inference_container');

        foreach ($inferenceDatas as $key => $data) {
            $inference = new Definition('Rezzza\RulerBundle\Ruler\Inference\Inference', array(
                $key, $data['type'], $data['description'], $data['event']
            ));

            foreach ($data['event'] as $event) {
                if (!isset($events[$event])) {
                    throw new \LogicException(sprintf('Event "%s" is not defined', $event));
                }

                $events[$event]->addMethodCall('addInference', array($inference));
            }

            $inferenceContainer->addMethodCall('add', array($inference));
        }

        /* --- functions --- */

        $rulerDefinition =  $container->getDefinition('rezzza.ruler');

        foreach ($container->findTaggedServiceIds('rezzza.ruler.functions') as $id => $tagAttributes) {
            $rulerDefinition->addMethodCall('addFunctionCollection', array(new Reference($id)));
        }
    }
}
