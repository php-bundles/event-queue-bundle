<?php

namespace SymfonyBundles\EventQueueBundle\Service\Exception;

use Symfony\Component\EventDispatcher\Event;

class InvalidEventParentClassException extends \InvalidArgumentException
{

    /**
     * {@inheritdoc}
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        $message = sprintf('Class "%s" must extending class "%s"', $message, Event::class);

        parent::__construct($message, $code, $previous);
    }

}
