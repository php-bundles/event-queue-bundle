<?php

namespace SymfonyBundles\EventQueueBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $builder->root('sb_event_queue')
            ->addDefaultsIfNotSet()->children()
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

        return $builder;
    }

}
