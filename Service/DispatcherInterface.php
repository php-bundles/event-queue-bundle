<?php

namespace SymfonyBundles\EventQueueBundle\Service;

use SymfonyBundles\QueueBundle\Service\QueueInterface;

interface DispatcherInterface extends QueueInterface
{

    /**
     * Adds an event listener to the queue.
     *
     * @param string $class   The event class name.
     * @param mixed  ...$args The transmitted arguments to the constructor.
     *
     * @throws Exception\InvalidEventNameException
     * @throws Exception\InvalidEventParentClassException
     *
     * @return void
     */
    public function on($class, ...$args);

    /**
     * Dispatches an event from queue.
     *
     * @return false|\Symfony\Component\EventDispatcher\Event
     */
    public function dispatch();
}
