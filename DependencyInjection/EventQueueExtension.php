<?php

namespace SymfonyBundles\EventQueueBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class EventQueueExtension extends ConfigurableExtension
{

    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader(
            $container, new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.yml');

        $container->setAlias($mergedConfig['service_name'], 'sb_event_queue');
        $container->setParameter('sb_event_queue.default_name', $mergedConfig['default_name']);
        $container->setParameter('sb_event_queue.storage_path', $mergedConfig['storage_path']);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'sb_event_queue';
    }

}
