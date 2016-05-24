<?php

namespace SymfonyBundles\EventQueueBundle\Tests\Command\Daemon;

use SymfonyBundles\EventQueueBundle\Tests\ConsoleTestCase;
use SymfonyBundles\EventQueueBundle\Command\Daemon\StopCommand;

class StopCommandTest extends ConsoleTestCase
{

    public function testConfigure()
    {
        $command = new StopCommand;

        $this->assertEquals('event:queue:daemon:stop', $command->getName());
    }

}
