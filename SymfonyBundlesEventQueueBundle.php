<?php

namespace SymfonyBundles\EventQueueBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use SymfonyBundles\BundleDependency\BundleDependency;
use SymfonyBundles\BundleDependency\BundleDependencyInterface;

class SymfonyBundlesEventQueueBundle extends Bundle implements BundleDependencyInterface
{

    use BundleDependency;

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new DependencyInjection\EventQueueExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function getBundleDependencies()
    {
        return [
            \SymfonyBundles\QueueBundle\SymfonyBundlesQueueBundle::class
        ];
    }

}
