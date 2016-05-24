<?php

namespace SymfonyBundles\EventQueueBundle\Tests\Service\EventSubscriber;

use SymfonyBundles\EventQueueBundle\Tests\Service\Event\ExampleEvent;

class ExampleSubscriber
{

    /**
     * @param ExampleEvent $event
     */
    public function hashMessage(ExampleEvent $event)
    {
        return md5($event->getMessage());
    }

}
