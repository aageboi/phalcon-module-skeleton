<?php

namespace PhalconApp\Controllers;

use Phalcon\Mvc\Dispatcher;

/**
 * \PhalconApp\Controllers\Controller
 *
 * @property \PhalconApp\Auth\Auth $auth
 * @property \Phalcon\Config $config
 * @property \PhalconApp\Utils\PhalconApp $PhalconApp
 *
 * @package PhalconApp\Controllers
 */
class Controller extends AbstractController
{

    /**
     * @var bool
     */
    protected $jsonResponse = false;


    /**
     * Check if we need to throw a json response. For ajax calls.
     *
     * @return bool
     */
    public function isJsonResponse()
    {
        return $this->jsonResponse;
    }

    /**
     * Set a flag in order to know if we need to throw a json response.
     *
     * @return $this
     */
    public function setJsonResponse()
    {
        $this->jsonResponse = true;

        return $this;
    }

    /**
     * After execute route event
     *
     * @param Dispatcher $dispatcher
     */
    public function afterExecuteRoute(Dispatcher $dispatcher)
    {
        if ($this->request->isAjax() && $this->isJsonResponse()) {
            $this->view->disable();
            $this->response->setContentType('application/json', 'UTF-8');

            $data = $dispatcher->getReturnedValue();
            if (is_array($data)) {
                $this->response->setJsonContent($data);
            }
            echo $this->response->getContent();
        }
    }

    public function onConstruct()
    {
        $this->view->setVars([
            'name'          => $this->config->application->name,
            'publicUrl'     => $this->config->application->publicUrl,
            'action'        => $this->router->getActionName(),
            'controller'    => $this->router->getControllerName(),
            'baseUri'       => $this->config->application->baseUri
        ]);
    }

}