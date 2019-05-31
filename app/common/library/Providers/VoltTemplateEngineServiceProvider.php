<?php

namespace PhalconApp\Common\Library\Providers;

use Phalcon\DiInterface;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\ViewBaseInterface;
use PhalconApp\Common\Library\Volt\VoltFunctions;

/**
 * \PhalconApp\Common\Library\Providers\VoltTemplateEngineServiceProvider
 *
 * @package PhalconApp\Common\Library\Providers
 */
class VoltTemplateEngineServiceProvider extends AbstractServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $serviceName = 'volt';

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register()
    {
        $this->di->setShared(
            $this->serviceName,
            function (ViewBaseInterface $view, DiInterface $di = null) {
                /** @var \Phalcon\DiInterface $this */
                $config = $this->getShared('config');

                $volt = new Volt($view, $di ?: $this);

                $volt->setOptions(
                    [
                        'compiledPath'      => $config->application->view->compiledPath,
                        'compiledSeparator' => $config->application->view->compiledSeparator,
                        'compiledExtension' => $config->application->view->compiledExtension,
                        'compileAlways'     => (bool) $config->application->debug,
                    ]
                );

                $volt->getCompiler()->addExtension(new VoltFunctions());

                return $volt;
            }
        );
    }
}
