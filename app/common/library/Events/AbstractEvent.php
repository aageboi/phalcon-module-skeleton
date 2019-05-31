<?php

namespace PhalconApp\Common\Library\Events;

use Phalcon\DiInterface;
use Phalcon\Di\Injectable;
use PhalconApp\Common\InjectableTrait;

/**
 * \PhalconApp\Common\Library\Events\AbstractEvent
 *
 * @property \Phalcon\Logger\AdapterInterface $logger
 *
 * @package PhalconApp\Common\Library\Events
 */
abstract class AbstractEvent extends Injectable
{
    use InjectableTrait;

    /**
     * AbstractEvent constructor.
     *
     * @param DiInterface|null $di
     */
    public function __construct(DiInterface $di = null)
    {
        if ($di) {
            $this->setDI($di);
        }

        $this->injectDependencies();
    }
}
