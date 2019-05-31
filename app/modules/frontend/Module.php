<?php

namespace PhalconApp\Frontend;

use Phalcon\Loader;
use Phalcon\DiInterface;
use PhalconApp\Common\Module as BaseModule;
use PhalconApp\Common\Library\Events\ViewListener;

/**
 * \PhalconApp\Frontend\Module
 *
 * @package PhalconApp\Frontend
 */
class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getHandlersNamespace()
    {
        return 'PhalconApp\Frontend\Controllers';
    }

    /**
     * Registers an autoloader related to the module.
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $namespaces = [
            $this->getHandlersNamespace() => __DIR__ . '/controllers/',
        ];

        $loader->registerNamespaces($namespaces, true);

        $loader->register();
    }

    /**
     * Registers services related to the module.
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        // Read configuration
        $moduleConfig = require __DIR__ . '/config/config.php';

        // Tune Up the URL Component
        $url = $di->getShared('url');
        $url->setBaseUri($moduleConfig->application->baseUri);

        $eventsManager = $di->getShared('eventsManager');
        $eventsManager->attach('view:notFoundView', new ViewListener($di));

        // Setting up the View Component
        $view = $di->getShared('view');
        $view->setViewsDir($moduleConfig['viewsDir']);
    }
}
