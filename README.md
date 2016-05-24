Symfony EventQueue Bundle
=========================

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
    service_name: "event_queue"
    default_name: "event:default"
    storage_path: "%kernel.cache_dir%/event-queue-daemon.%s.pid"
```

* Configure the redis client in your config.yml. Read more [QueueBundle Installation][queue-bundle-link].

For example, defaults configuration:
``` yml
sb_queue:
    server:
        redis:
            parameters:
                - "tcp://localhost?alias=queue"
            options:
                prefix: "sb_queue:"
```

How to use
----------

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
[queue-bundle-link]: https://github.com/symfony-bundles/queue-bundle#installation
