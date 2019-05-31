<?php

use PhalconApp\Common\Library\Providers;

return [
    Providers\RoutingServiceProvider::class,
    Providers\ModulesServiceProvider::class,
    Providers\ViewServiceProvider::class,
    Providers\ConfigServiceProvider::class,
    Providers\VoltTemplateEngineServiceProvider::class,
    Providers\PhpTemplateEngineServiceProvider::class,
    Providers\MvcDispatcherServiceProvider::class,
    Providers\ResponseServiceProvider::class,
    Providers\LoggerServiceProvider::class,
    Providers\RequestServiceProvider::class,
    Providers\UrlResolverServiceProvider::class,
];