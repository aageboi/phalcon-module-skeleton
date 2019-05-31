<?php

namespace PhalconApp\Controllers;

use Phalcon\Di\Injectable;
use PhalconApp\Common\InjectableTrait;
use Phalcon\Mvc\ControllerInterface;

/**
 * \PhalconApp\Controllers\AbstractController
 *
 * @package PhalconApp\Controllers
 */
abstract class AbstractController extends Injectable implements ControllerInterface
{
    use InjectableTrait;

    /**
     * AbstractController constructor.
     */
    final public function __construct()
    {
        if (method_exists($this, "onConstruct")) {
            $this->onConstruct();
        }

        $this->injectDependencies();
    }
}
