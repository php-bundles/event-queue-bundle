<?php

namespace SymfonyBundles\EventQueueBundle\DependencyInjection;

use SymfonyBundles\EventQueueBundle\Service;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $rootNode = $builder->root('sb_event_queue');

        $this->addRootSection($rootNode);
        $this->addClassSection($rootNode);

        return $builder;
    }

    /**
     * Adds root node configuration.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addRootSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('service_name')
                    ->defaultValue('event_queue')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('default_name')
                    ->defaultValue('event:default')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('storage_path')
                    ->defaultValue('%kernel.cache_dir%/event-queue-daemon.%s.pid')
                    ->cannotBeEmpty()
                ->end()
            ->end();
    }

    /**
     * Adds the sb_event_queue.class configuration.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addClassSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('dispatcher')
                            ->defaultValue(Service\Dispatcher::class)
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

}
