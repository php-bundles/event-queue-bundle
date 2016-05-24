<?php

namespace SymfonyBundles\EventQueueBundle\Service\Exception;

class InvalidEventNameException extends \InvalidArgumentException
{

    /**
     * {@inheritdoc}
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        $message = sprintf('Class "%s" must have constant "NAME"', $message);

        parent::__construct($message, $code, $previous);
    }

}
