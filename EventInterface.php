<?php

namespace SymfonyBundles\EventQueueBundle;

interface EventInterface
{

    /**
     * Returns whether further event listeners should be triggered.
     *
     * @see EventInterface::stopPropagation()
     *
     * @return bool Whether propagation was already stopped for this event.
     */
    public function isPropagationStopped();

    /**
     * Stops the propagation of the event to further event listeners.
     *
     * If multiple event listeners are connected to the same event, no
     * further event listener will be triggered once any trigger calls
     * stopPropagation().
     */
    public function stopPropagation();

    /**
     * Gets the name of event.
     *
     * @return string
     */
    public function getName();
}
