<?php

namespace PhalconApp\Common\Library\Providers;

use Phalcon\Mvc\Url;

/**
 * \PhalconApp\Common\Library\Providers\UrlResolverServiceProvider
 *
 * @package PhalconApp\Common\Library\Providers
 */
class UrlResolverServiceProvider extends AbstractServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'url';

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register()
    {
        $this->di->setShared(
            $this->serviceName,
            function () {
                /** @var \Phalcon\DiInterface $this */
                $config = $this->getShared('config');

                $url = new Url();

                if (isset($config->application->staticBaseUri)) {
                    $url->setStaticBaseUri($config->application->staticBaseUri);
                } else {
                    $url->setStaticBaseUri('/');
                }

                if (isset($config->application->baseUri)) {
                    $url->setBaseUri($config->application->baseUri);
                } else {
                    $url->setBaseUri('/');
                }

                return $url;
            }
        );
    }
}
