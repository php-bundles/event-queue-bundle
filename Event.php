<?php

namespace SymfonyBundles\EventQueueBundle;

use Symfony\Component\EventDispatcher\Event as BaseEvent;

abstract class Event extends BaseEvent implements EventInterface
{

    /**
     * @var string
     */
    const NAME = 'override.event.name';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return static::NAME;
    }

}
