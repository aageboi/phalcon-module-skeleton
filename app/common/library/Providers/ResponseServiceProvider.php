<?php

namespace PhalconApp\Common\Library\Providers;

use Phalcon\Http\Response;

/**
 * \PhalconApp\Common\Library\Providers\ResponseServiceProvider
 *
 * @package PhalconApp\Common\Library\Providers
 */
class ResponseServiceProvider extends AbstractServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'response';

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register()
    {
        $this->di->setShared($this->serviceName, Response::class);
    }
}
