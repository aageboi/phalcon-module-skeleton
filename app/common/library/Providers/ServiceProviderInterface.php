<?php

namespace PhalconApp\Common\Library\Providers;

use Phalcon\Di\InjectionAwareInterface;

/**
 * \PhalconApp\Common\Library\Providers\ServiceProviderInterface
 *
 * @package PhalconApp\Common\Library\Providers
 */
interface ServiceProviderInterface extends InjectionAwareInterface
{
    /**
     * Register application service.
     *
     * @return void
     */
    public function register();

    /**
     * Package boot method.
     *
     * @return void
     */
    public function boot();

    /**
     * Configures the current service provider.
     *
     * @return void
     */
    public function configure();

    /**
     * Get the Service name.
     *
     * @return string
     */
    public function getName();
}
