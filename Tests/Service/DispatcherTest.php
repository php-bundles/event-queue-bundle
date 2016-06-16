<?php

namespace SymfonyBundles\EventQueueBundle\Tests\Service;

use SymfonyBundles\EventQueueBundle\Tests\TestCase;
use SymfonyBundles\EventQueueBundle\Service\Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use SymfonyBundles\EventQueueBundle\Tests\Service\Event\ExampleEvent;

class DispatcherTest extends TestCase
{

    /**
     * @var \SymfonyBundles\EventQueueBundle\Service\DispatcherInterface
     */
    protected $dispatcher;

    public function setUp()
    {
        parent::setUp();

        $this->dispatcher = $this->container->get('sb_event_queue');

        $this->dispatcher->setName('unit-test');

        while ($this->dispatcher->count()) {
            $this->dispatcher->pop();
        }
    }

    public function testSetDispatcher()
    {
        $reflection = new \ReflectionClass($this->dispatcher);
        $method = $reflection->getMethod('setDispatcher');
        $interface = $method->getParameters()[0]->getClass()->getName();

        $this->assertSame($interface, EventDispatcherInterface::class);
    }

    public function testInvalidEventName()
    {
        $this->expectException(Exception\InvalidEventNameException::class);

        $this->dispatcher->on(Event\InvalidEventName::class);
    }

    public function testInvalidEventParentClass()
    {
        $this->expectException(Exception\EventInterfaceImplementationException::class);

        $this->dispatcher->on(Event\InvalidEventParentClass::class);
    }

    public function testEmptyDispatch()
    {
        $this->assertSame(false, $this->dispatcher->dispatch());
    }

    public function testOn()
    {
        $this->assertSame(0, $this->dispatcher->count());

        $this->dispatcher->on(ExampleEvent::class, 'foo');
        $this->dispatcher->on(ExampleEvent::class, 'baz');

        $this->assertSame(2, $this->dispatcher->count());
    }

    public function testDispatch()
    {
        $this->dispatcher->on(ExampleEvent::class, 'foo');
        $this->dispatcher->on(ExampleEvent::class, 'baz');

        $event = $this->dispatcher->dispatch();

        $this->assertSame('foo', $event->getMessage());

        $event = $this->dispatcher->dispatch();

        $this->assertSame('baz', $event->getMessage());

        $this->assertSame(0, $this->dispatcher->count());
    }

}
