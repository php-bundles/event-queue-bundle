<?php

namespace SymfonyBundles\EventQueueBundle\Tests\DependencyInjection;

use SymfonyBundles\EventQueueBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use SymfonyBundles\EventQueueBundle\DependencyInjection\EventQueueExtension;

class EventQueueExtensionTest extends TestCase
{

    public function testHasServices()
    {
        $container = new ContainerBuilder;
        $extension = new EventQueueExtension;

        $this->assertInstanceOf(Extension::class, $extension);

        $extension->load([], $container);

        $this->assertTrue($container->has('sb_event_queue'));
    }

    public function testAlias()
    {
        $extension = new EventQueueExtension;

        $this->assertStringEndsWith('event_queue', $extension->getAlias());
    }

}
