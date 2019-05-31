<?php

namespace PhalconApp\Common\Library\Events;

use Phalcon\Mvc\Dispatcher as PhDispatcher;

/**
 * \PhalconApp\Common\Library\Mvc\Dispatcher
 *
 * @package PhalconApp\Common\Library\Mvc
 */
class MvcDispatcher extends PhDispatcher
{
    /**
     * {@inheritdoc}
     *
     * @param array $forward
     */
    public function forward($forward)
    {
        $this->getEventsManager()->fire('dispatch:beforeForward', $this, $forward);

        parent::forward($forward);
    }
}
