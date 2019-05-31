<?php

namespace PhalconApp\Common\Library\Providers;

use Phalcon\Registry;
use RecursiveDirectoryIterator;
// use PhalconApp\Oauth\Module as oAuth;
// use PhalconApp\Error\Module as Error;
// use PhalconApp\Backend\Module as Backend;
// use PhalconApp\Frontend\Module as Frontend;
// use PhalconApp\Api\Module as Api;
use Phalcon\Cli\Console as ConsoleApplication;
use Phalcon\Mvc\Application as MvcApplication;

/**
 * \PhalconApp\Common\Library\Providers\ModulesServiceProvider
 *
 * @package PhalconApp\Common\Library\Providers
 */
class ModulesServiceProvider extends AbstractServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'modules';

    protected $modules = [];

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function configure()
    {
        $directory = new RecursiveDirectoryIterator(modules_path());

        foreach ($directory as $item) {
            $name = $item->getFilename();
            if (!$item->isDir() || $name[0] == '.') {
                continue;
            }

            $this->modules[$name] = [
                'className' => 'PhalconApp\\' . ucfirst($name) . '\\Module',
                'path'      => modules_path("{$name}/Module.php"),
                'router'    => modules_path("{$name}/config/routing.php"),
            ];
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register()
    {
        $modules = $this->modules;

        $this->di->setShared(
            $this->serviceName,
            function () use ($modules) {
                $modulesRegistry = new Registry();

                foreach ($modules as $name => $module) {
                    $modulesRegistry->offsetSet($name, (object) $module);
                }

                return $modulesRegistry;
            }
        );
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function boot()
    {
        $modules = [];

        foreach ($this->modules as $name => $module) {
            $modules[$name] = function () use ($module) {
                $moduleClass = $module['className'];
                if (!class_exists($moduleClass)) {
                    /** @noinspection PhpIncludeInspection */
                    include_once $module['path'];
                }

                /** @var \PhalconApp\Common\ModuleInterface $moduleBootstrap */
                $moduleBootstrap = new $moduleClass(container());

                $moduleBootstrap->initialize();

                return $moduleBootstrap;
            };

            $this->getDI()->setShared($module['className'], $modules[$name]);
        }

        /** @var MvcApplication|ConsoleApplication $application */
        $application = container('bootstrap')->getApplication();

        if ($application instanceof ConsoleApplication) {
            $application->registerModules($this->modules);
        } else {
            $application->registerModules($modules);
        }
    }
}
