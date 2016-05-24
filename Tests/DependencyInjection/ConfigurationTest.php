<?php

namespace SymfonyBundles\EventQueueBundle\Tests\DependencyInjection;

use SymfonyBundles\EventQueueBundle\Tests\TestCase;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use SymfonyBundles\EventQueueBundle\DependencyInjection\Configuration;

class ConfigurationTest extends TestCase
{

    public function testConfiguration()
    {
        $processor = new Processor;
        $configuration = new Configuration;

        $this->assertInstanceOf(ConfigurationInterface::class, $configuration);

        $configs = $processor->processConfiguration($configuration, []);

        $this->assertArraySubset([], $configs);
    }

}
