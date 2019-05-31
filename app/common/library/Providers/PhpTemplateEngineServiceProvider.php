<?php

namespace PhalconApp\Common\Library\Providers;

use Phalcon\DiInterface;
use Phalcon\Mvc\ViewBaseInterface;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;

/**
 * \PhalconApp\Common\Library\Providers\PhpTemplateEngineServiceProvider
 *
 * @package PhalconApp\Common\Library\Providers
 */
class PhpTemplateEngineServiceProvider extends AbstractServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'phpEngine';

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register()
    {
        $this->di->setShared(
            $this->serviceName,
            function (ViewBaseInterface $view, DiInterface $di = null) {
                return new PhpEngine($view, $di ?: $this);
            }
        );
    }
}
