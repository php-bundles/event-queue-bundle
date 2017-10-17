<?php

namespace SymfonyBundles\EventQueueBundle\Tests\Command\Daemon;

use SymfonyBundles\EventQueueBundle\Command;
use SymfonyBundles\EventQueueBundle\Tests\ConsoleTestCase;
use SymfonyBundles\EventQueueBundle\Tests\Service\Event\ExampleEvent;

class StartCommandTest extends ConsoleTestCase
{
    public function testConfigure()
    {
        $command = new Command\Daemon\StartCommand();

        $this->assertEquals('event:queue:daemon:start', $command->getName());
    }

    public function testExecute()
    {
        $this->dispatcher->on(ExampleEvent::class, 'first message');
        $this->dispatcher->on(ExampleEvent::class, 'second message');
        $this->dispatcher->on(ExampleEvent::class, 'third message');

        $this->assertSame(3, $this->dispatcher->count());

        $this->createTester(new Command\DispatchCommand(), 'event:queue:dispatch');

        $start = $this->createTester(new Command\Daemon\StartCommand(), 'event:queue:daemon:start');

        $start->execute([
            '--name' => 'unit-test',
            '--delay' => 0,
            '--iterations' => 1,
        ]);

        $this->assertSame(0, $this->dispatcher->count());

        $stop = $this->createTester(new Command\Daemon\StopCommand(), 'event:queue:daemon:stop');

        $stop->execute(['--name' => 'unit-test']);
    }
}
