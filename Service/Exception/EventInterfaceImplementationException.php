<?php

namespace SymfonyBundles\EventQueueBundle\Service\Exception;

use SymfonyBundles\EventQueueBundle\EventInterface;

class EventInterfaceImplementationException extends \InvalidArgumentException
{

    /**
     * {@inheritdoc}
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        $message = sprintf('Class "%s" must implement interface "%s"', $message, EventInterface::class);

        parent::__construct($message, $code, $previous);
    }

}
