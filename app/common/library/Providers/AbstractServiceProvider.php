<?php

namespace PhalconApp\Common\Library\Providers;

use LogicException;
use Phalcon\DiInterface;
use Phalcon\Mvc\User\Component;

/**
 * \PhalconApp\Common\Library\Providers\AbstractServiceProvider
 *
 * Base class for all providers.
 *
 * @package PhalconApp\Common\Library\Providers
 */
abstract class AbstractServiceProvider extends Component implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName;

    /**
     * The Service Provider constructor.
     *
     * @param DiInterface $di The Dependency Injector.
     */
    final public function __construct(DiInterface $di)
    {
        if (!$this->serviceName) {
            throw new LogicException(
                sprintf('The service provider defined in "%s" cannot have an empty name.', get_class($this))
            );
        }

        $this->setDI($di);

        $this->configure();
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return $this->serviceName;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function configure()
    {
    }
}
