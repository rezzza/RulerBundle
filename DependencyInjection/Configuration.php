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
            ->children()
                ->arrayNode('events')
                    ->useAttributeAsKey('name')
                        ->prototype('scalar')
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
