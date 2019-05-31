<?php

namespace PhalconApp\Common\Library\Providers;

use Phalcon\Events\Manager;

/**
 * \PhalconApp\Common\Library\Providers\EventManagerServiceProvider
 *
 * @package PhalconApp\Common\Library\Providers
 */
class EventManagerServiceProvider extends AbstractServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'eventsManager';

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
                $em = new Manager();
                $em->enablePriorities(true);

                return $em;
            }
        );
    }
}
