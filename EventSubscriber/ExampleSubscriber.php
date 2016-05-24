<?php

namespace SymfonyBundles\EventQueueBundle\EventSubscriber;

use SymfonyBundles\EventQueueBundle\Event\ExampleEvent;

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
