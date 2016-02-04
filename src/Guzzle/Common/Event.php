<?php

namespace Guzzle\Common;

use Symfony\Component\EventDispatcher\Event as SymfonyEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Default event for Guzzle notifications
 */
class Event extends SymfonyEvent implements ToArrayInterface, \ArrayAccess, \IteratorAggregate
{
    /** @var array */
    private $context;

    /**
     * @var EventDispatcher that dispatched this event
     */
    private $dispatcher;

    /**
     * @var string This event's name
     */
    private $name;

    /**
     * @param array $context Contextual information
     */
    public function __construct(array $context = array())
    {
        $this->context = $context;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->context);
    }

    public function offsetGet($offset)
    {
        return isset($this->context[$offset]) ? $this->context[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        $this->context[$offset] = $value;
    }

    public function offsetExists($offset)
    {
        return isset($this->context[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->context[$offset]);
    }

    public function toArray()
    {
        return $this->context;
    }

    /**
     * Stores the EventDispatcher that dispatches this Event.
     *
     * @param EventDispatcherInterface $dispatcher
     *
     * @deprecated
     */
    public function setDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Returns the EventDispatcher that dispatches this Event.
     *
     * @return EventDispatcherInterface
     *
     * @deprecated
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * Gets the event's name.
     *
     * @return string
     *
     * @deprecated
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the event's name property.
     *
     * @param string $name The event name.
     *
     * @deprecated
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
