<?php

namespace Rezzza\RulerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 *
 * @uses ConfigurationInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('rezzza_ruler');

        $rootNode
            ->beforeNormalization()
                ->ifTrue(function($v) {
                    return isset($v['context_builder']) && is_scalar($v['context_builder']);
                })
                ->then(function($v) {
                    $v['context_builder'] = array('default' => $v['context_builder']);
                    return $v;
                })
                ->end()
            ->children()
                ->booleanNode('property_access')->defaultValue(true)->end()
                ->arrayNode('context_builder')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('events')
                    ->beforeNormalization()
                        ->ifTrue(function($events) {
                            foreach ($events as $event) {
                                if (is_scalar($event)) {
                                    return true;
                                }
                            }

                            return false;
                        })
                        ->then(function($events) {
                            foreach ($events as $k => $event) {
                                if (is_scalar($event)) {
                                    $events[$k] = array('label' => $event);
                                }
                            }

                            return $events;
                        })
                    ->end()
                    ->prototype('array')
                        ->children()
                            ->scalarNode('label')->isRequired()->end()
                            ->scalarNode('context_builder')->defaultValue('default')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('inferences')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('type')->isRequired()->end()
                            ->scalarNode('description')->end()
                            ->arrayNode('event')
                                ->prototype('scalar')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

}
