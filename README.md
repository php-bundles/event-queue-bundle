SymfonyBundlesEventQueueBundle
==============================

[![SensioLabsInsight][sensiolabs-insight-image]][sensiolabs-insight-link]

[![Build Status][testing-image]][testing-link]
[![Scrutinizer Code Quality][scrutinizer-code-quality-image]][scrutinizer-code-quality-link]
[![Code Coverage][code-coverage-image]][code-coverage-link]
[![Total Downloads][downloads-image]][package-link]
[![Latest Stable Version][stable-image]][package-link]
[![License][license-image]][license-link]

Installation
------------

* Require the bundle with composer:

``` bash
composer require symfony-bundles/event-queue-bundle
```

* Enable the bundle in the kernel:

``` php
public function registerBundles()
{
    $bundles = [
        // ...
        new SymfonyBundles\EventQueueBundle\SymfonyBundlesEventQueueBundle(),
        // ...
    ];
    ...
}
```

* Configure the EventQueue bundle in your config.yml.

Defaults configuration:

``` yml
sb_event_queue:
    service_name: 'event_queue'
    default_name: 'event:default'
    storage_path: '%kernel.cache_dir%/event-queue-daemon.%s.pid'
```

* Configure the redis client in your config.yml. Read more about [RedisBundle configuration][redis-bundle-link].

How to use
----------

Add an event to the queue:

``` php
$dispatcher = $this->get('sb_event_queue');

$dispatcher->on(MyEvent::class, date('Y-m-d H:i:s'), 'Example message');
```

Your event class must implement `SymfonyBundles\EventQueueBundle\EventInterface`
(or extending `SymfonyBundles\EventQueueBundle\Event` class)
and having constant `NAME` with the event name. For example:

``` php
namespace AppBundle\Event;

use SymfonyBundles\EventQueueBundle\Event;

class MyEvent extends Event
{
    const NAME = 'event.example';

    private $time;
    private $message;

    public function __construct($time, $message)
    {
        $this->time = $time;
        $this->message = $message;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
```

Creating an Event Listener.
The most common way to listen to an event is to register an event listener:

``` php
namespace AppBundle\EventListener;

use AppBundle\Event\MyEvent;

class MyListener
{
    public function onEventExample(MyEvent $event)
    {
        $event->getTime();
        $event->getMessage();

        // and we are doing something...
    }
}
```

Now that the class is created, you just need to register it as a service and notify Symfony that it is a "listener":

``` yml
services:
    app.my_listener:
        class: AppBundle\EventListener\MyListener
        tags:
            - { name: kernel.event_listener, event: event.example }
```

Execution (dispatching) of all events from the queue:

``` php
while ($dispatcher->count()) {
    $dispatcher->dispatch();
}
```

You can separate the events by section, specifying in event manager the needed section.

``` php
$dispatcher->setName('email.notifications');

$dispatcher->on(EmailNotifyEvent::class, 'Subject', 'Message Body', ['john@domain.com', 'alex@domain.com']);
$dispatcher->on(EmailNotifyEvent::class, 'Another subject', 'Another message Body', ['demo@domain.com']);

$dispatcher->setName('database.reindex');

$dispatcher->on(DatabaseReindexEvent::class, 'users');
$dispatcher->on(DatabaseReindexEvent::class, 'orders');
$dispatcher->on(DatabaseReindexEvent::class, 'products');
```

In this example, will be executed only an events from the section `email.notifications`:

``` php
$dispatcher->setName('email.notifications');

while ($dispatcher->count()) {
    $dispatcher->dispatch();
}
```

Console commands:

* `event:queue:dispatch`
* `event:queue:daemon:start`
* `event:queue:daemon:stop`

In what situations is useful to apply the queue of events:

* When sending email messages
* Parsing websites
* and in other cases, when the execution time of process is very long,
and the response from the server must be returned immediately.

[package-link]: https://packagist.org/packages/symfony-bundles/event-queue-bundle
[license-link]: https://github.com/symfony-bundles/event-queue-bundle/blob/master/LICENSE
[license-image]: https://poser.pugx.org/symfony-bundles/event-queue-bundle/license
[testing-link]: https://travis-ci.org/symfony-bundles/event-queue-bundle
[testing-image]: https://travis-ci.org/symfony-bundles/event-queue-bundle.svg?branch=master
[stable-image]: https://poser.pugx.org/symfony-bundles/event-queue-bundle/v/stable
[downloads-image]: https://poser.pugx.org/symfony-bundles/event-queue-bundle/downloads
[sensiolabs-insight-link]: https://insight.sensiolabs.com/projects/696a4b02-8d4c-45ca-924c-c61f8f06ed9e
[sensiolabs-insight-image]: https://insight.sensiolabs.com/projects/696a4b02-8d4c-45ca-924c-c61f8f06ed9e/big.png
[code-coverage-link]: https://scrutinizer-ci.com/g/symfony-bundles/event-queue-bundle/?branch=master
[code-coverage-image]: https://scrutinizer-ci.com/g/symfony-bundles/event-queue-bundle/badges/coverage.png?b=master
[scrutinizer-code-quality-link]: https://scrutinizer-ci.com/g/symfony-bundles/event-queue-bundle/?branch=master
[scrutinizer-code-quality-image]: https://scrutinizer-ci.com/g/symfony-bundles/event-queue-bundle/badges/quality-score.png?b=master
[redis-bundle-link]: https://github.com/symfony-bundles/redis-bundle#installation
