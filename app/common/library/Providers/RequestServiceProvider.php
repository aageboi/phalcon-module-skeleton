<?php

namespace PhalconApp\Common\Library\Providers;

use Phalcon\Http\Request;

/**
 * \PhalconApp\Common\Library\Providers\RequestServiceProvider
 *
 * @package PhalconApp\Common\Library\Providers
 */
class RequestServiceProvider extends AbstractServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'request';

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register()
    {
        $this->di->setShared($this->serviceName, Request::class);
    }
}
