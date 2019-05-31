<?php

namespace PhalconApp\Common\Library\Providers;

use Phalcon\Mvc\Router as MvcRouter;
use Phalcon\Cli\Router as CliRouter;
use Phalcon\Mvc\Router\GroupInterface;

/**
 * \PhalconApp\Common\Library\Providers\RoutingServiceProvider
 *
 * @package PhalconApp\Common\Library\Providers
 */
class RoutingServiceProvider extends AbstractServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'router';

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
                $bootstrap = container('bootstrap');

                $bootstrap->getMode();

                if ($bootstrap->getMode() == 'cli') {
                    $router = new CliRouter();
                    $router->setDefaultModule('cli');
                } else {
                    $router = new MvcRouter(false);
                    $router->removeExtraSlashes(true);

                    foreach (container('modules') as $module) {
                        if (empty($module->router)) {
                            continue;
                        }

                        /** @noinspection PhpIncludeInspection */
                        $group = require $module->router;

                        if (!$group || !$group instanceof GroupInterface) {
                            continue;
                        }

                        $router->mount($group);
                        $router->setEventsManager(container('eventsManager'));
                    }
                }

                $router->setDI(container());

                return $router;
            }
        );
    }
}
