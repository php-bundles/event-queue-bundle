<?php

namespace SymfonyBundles\EventQueueBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class EventQueueExtension extends ConfigurableExtension
{

    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $configs, ContainerBuilder $container)
    {
        $alias = $this->getAlias();

        $container->setParameter('sb_event_queue.default_name', $configs['default_name']);
        $container->setParameter('sb_event_queue.storage_path', $configs['storage_path']);

        $storageReference = new Reference('sb_queue.storage');
        $dispatcherReference = new Reference('event_dispatcher');

        $definition = new Definition($configs['class']['dispatcher']);
        $definition->addMethodCall('setName', [$configs['default_name']]);
        $definition->addMethodCall('setStorage', [$storageReference]);
        $definition->addMethodCall('setDispatcher', [$dispatcherReference]);

        $container->setDefinition($alias, $definition);
        $container->setAlias($configs['service_name'], $alias);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'sb_event_queue';
    }

}
