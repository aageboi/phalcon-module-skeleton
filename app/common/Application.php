<?php

namespace PhalconApp\Common;

use Phalcon\Di;
use Dotenv\Dotenv;
use Phalcon\Mvc\Application as MvcApplication;
use Phalcon\Application as AbstractApplication;
use InvalidArgumentException;
use PhalconApp\Common\Library\Providers\EventManagerServiceProvider;

class Application
{
    /**
     * The Dependency Injector.
     * @var DiInterface
     */
    protected $di;

    /**
     * The Service Providers.
     * @var ServiceProviderInterface[]
     */
    protected $serviceProviders = [];

    /**
     * The Phalcon Application.
     * @var AbstractApplication
     */
    protected $app;

    /**
     * Application constructor.
     *
     * @param string $mode The Application mode: either "normal" either "cli" or "api".
     */
    public function __construct($mode = 'normal')
    {
        $dotenv = Dotenv::create(realpath(ROOT_DIR));
        $dotenv->load();

        $this->di = new Di();
        $this->app = $this->createInternalApplication($mode);

        $this->di->setShared('dotenv', $dotenv);
        $this->di->setShared('bootstrap', $this);

        Di::setDefault($this->di);
        $this->initializeServiceProvider(new EventManagerServiceProvider($this->di));

        /** @noinspection PhpIncludeInspection */
        $providers = require config_path('providers.php');
        if (is_array($providers)) {
            $this->initializeServiceProviders($providers);
        }

        $this->app->setEventsManager($this->di->getShared('eventsManager'));
        $this->app->setDI($this->di);
    }

    /**
     * Runs the Application.
     *
     * @return string
     */
    public function run()
    {
        return $this->getOutput();
    }

    /**
     * Get current Application instance.
     *
     * @return AbstractApplication|Console|MvcApplication
     */
    public function getApplication()
    {
        return $this->app;
    }

    /**
     * Get registered service providers.
     *
     * @return ServiceProviderInterface[]
     */
    public function getServiceProviders()
    {
        return $this->serviceProviders;
    }

    /**
     * Get Application output.
     *
     * @return ResponseInterface|string
     */
    protected function getOutput()
    {
        $response = $this->app->handle();

        if ($this->app instanceof MvcApplication) {
            return $response->getContent();
        } else {
            return $response;
        }
    }

    /**
     * Get Application mode.
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Initialize Services in the Dependency Injector Container.
     *
     * @param  string[] $providers
     * @return $this
     */
    protected function initializeServiceProviders(array $providers)
    {
        foreach ($providers as $name => $class) {
            $this->initializeServiceProvider(new $class($this->di));
        }

        return $this;
    }

    /**
     * Initialize the Service in the Dependency Injector Container.
     *
     * @param  ServiceProviderInterface $serviceProvider
     * @return $this
     */
    protected function initializeServiceProvider($serviceProvider)
    {
        $serviceProvider->register();
        $serviceProvider->boot();

        $this->serviceProviders[$serviceProvider->getName()] = $serviceProvider;

        return $this;
    }

    /**
     * Create internal Application to handle requests.
     *
     * @param  string $mode The Application mode.
     * @return Console|MvcApplication
     *
     * @throws InvalidArgumentException
     */
    protected function createInternalApplication($mode)
    {
        $this->mode = $mode;

        switch ($mode) {
            case 'normal':
                return new MvcApplication($this->di);
            case 'cli':
                return new Console($this->di);
            case 'api':
                throw new InvalidArgumentException(
                    'Not implemented yet.'
                );
            default:
                throw new InvalidArgumentException(
                    sprintf(
                        'Invalid Application mode. Expected either "normal" either "cli" or "api". Got %s',
                        is_scalar($mode) ? $mode : var_export($mode, true)
                    )
                );
        }
    }
}