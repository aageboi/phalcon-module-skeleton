<?php

namespace PhalconApp\Common;

use Phalcon\Events\EventsAwareInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

/**
 * \PhalconApp\Common\ModuleInterface
 *
 * @package PhalconApp\Common
 */
interface ModuleInterface extends ModuleDefinitionInterface, EventsAwareInterface
{
    /**
     * Initialize the module.
     */
    public function initialize();

    /**
     * Gets controllers/tasks namespace.
     *
     * @return string
     */
    public function getHandlersNamespace();
}
