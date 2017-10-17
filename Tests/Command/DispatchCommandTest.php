<?php

namespace SymfonyBundles\EventQueueBundle\Tests\Command;

use SymfonyBundles\EventQueueBundle\Tests\ConsoleTestCase;
use SymfonyBundles\EventQueueBundle\Command\DispatchCommand;
use SymfonyBundles\EventQueueBundle\Tests\Service\Event\ExampleEvent;

class DispatchCommandTest extends ConsoleTestCase
{
    public function testConfigure()
    {
        $command = new DispatchCommand();

        $this->assertSame('event:queue:dispatch', $command->getName());
    }

    public function testExecute()
    {
        $this->dispatcher->on(ExampleEvent::class, 'first message');
        $this->dispatcher->on(ExampleEvent::class, 'second message');
        $this->dispatcher->on(ExampleEvent::class, 'third message');

        $this->assertSame(3, $this->dispatcher->count());

        $tester = $this->createTester(new DispatchCommand(), 'event:queue:dispatch');

        $tester->execute(['--name' => 'unit-test']);

        $this->assertSame(0, $this->dispatcher->count());
    }
}
