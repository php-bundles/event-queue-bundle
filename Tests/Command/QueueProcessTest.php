<?php

namespace SymfonyBundles\EventQueueBundle\Tests\Command;

use SymfonyBundles\EventQueueBundle\Command\QueueProcess;
use SymfonyBundles\EventQueueBundle\Tests\ConsoleTestCase;

class QueueProcessTest extends ConsoleTestCase
{

    public function testExecute()
    {
        $process = $this->getProcess();

        $this->assertTrue($process->save());
        $this->assertTrue($process->has());
        $this->assertTrue($process->delete());
        $this->assertFalse($process->has());
        $this->assertFalse($process->delete());
        $this->assertFalse($process->kill());
    }

    private function getProcess()
    {
        $process = new QueueProcess;
        $path = $this->container->getParameter('sb_event_queue.storage_path');

        $process->setPath($path);
        $process->setQueueName('unit-test');

        return $process;
    }

}
