<?php

namespace PhalconApp\Error;

use Phalcon\Loader;
use Phalcon\DiInterface;
use PhalconApp\Common\Module as BaseModule;
use PhalconApp\Common\Library\Events\ViewListener;

/**
 * \PhalconApp\Error\Module
 *
 * @package PhalconApp\Error
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
        return 'PhalconApp\Error\Controllers';
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

        $eventsManager = $di->getShared('eventsManager');
        $eventsManager->attach('view:notFoundView', new ViewListener($di));

        // Setting up the View Component
        $view = $di->getShared('view');
        $view->setViewsDir($moduleConfig['viewsDir']);
    }
}
