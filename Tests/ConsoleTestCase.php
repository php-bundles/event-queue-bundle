<?php

namespace SymfonyBundles\EventQueueBundle\Tests;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

abstract class ConsoleTestCase extends TestCase
{

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var \SymfonyBundles\EventQueueBundle\Service\DispatcherInterface
     */
    protected $dispatcher;

    public function setUp()
    {
        parent::setUp();

        $this->app = new Application;

        $this->dispatcher = $this->container->get('sb_event_queue');

        $this->dispatcher->setName('unit-test');

        while ($this->dispatcher->count()) {
            $this->dispatcher->pop();
        }
    }

    protected function createTester(ContainerAwareInterface $obj, $shortcat)
    {
        $this->app->add($obj);

        $command = $this->app->find($shortcat);

        $obj->setContainer($this->container);

        return new CommandTester($command);
    }

}
