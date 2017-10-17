<?php

namespace SymfonyBundles\EventQueueBundle\Tests\Service\Event;

use Symfony\Component\EventDispatcher\Event;
use SymfonyBundles\EventQueueBundle\EventInterface;

class InvalidEventName extends Event implements EventInterface
{
    public function getName()
    {
        return 'invalid.event';
    }
}
