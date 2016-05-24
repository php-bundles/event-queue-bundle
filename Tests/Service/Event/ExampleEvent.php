<?php

namespace SymfonyBundles\EventQueueBundle\Tests\Service\Event;

use Symfony\Component\EventDispatcher\Event;

class ExampleEvent extends Event
{

    /**
     * @var string
     */
    const NAME = 'sb_event_queue.example';

    /**
     * @var string
     */
    private $message;

    /**
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

}
