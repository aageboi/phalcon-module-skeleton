<?php

namespace PhalconApp\Common\Library\Providers;

use Phalcon\Cli\Dispatcher as CliDi;
use PhalconApp\Common\Library\Events\AccessListener;
use PhalconApp\Common\Library\Events\MvcDispatcher as MvcDi;
use PhalconApp\Common\Library\Events\DispatcherListener;

/**
 * \PhalconApp\Common\Library\Providers\MvcDispatcherServiceProvider
 *
 * @package PhalconApp\Common\Library\Providers
 */
class MvcDispatcherServiceProvider extends AbstractServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'dispatcher';

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
                if (container('bootstrap')->getMode() == 'cli') {
                    $dispatcher = new CliDi();
                } else {
                    $dispatcher = new MvcDi();
                    container('eventsManager')->attach('dispatch:beforeDispatch', new AccessListener($this));
                }

                container('eventsManager')->attach('dispatch', new DispatcherListener($this));

                $dispatcher->setDI(container());
                $dispatcher->setEventsManager(container('eventsManager'));

                return $dispatcher;
            }
        );
    }
}
