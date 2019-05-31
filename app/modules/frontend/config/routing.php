<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

$frontend = new RouterGroup([
    'module'     => 'frontend',
    'controller' => 'posts',
    'action'     => 'index',
    'namespace'  => 'PhalconApp\Frontend\Controllers',
]);

$frontend->add('/', [
    'controller' => 'index',
    'action'     => 'index',
])->setName('wp');

$frontend->add('/tes', [
    'controller' => 'index',
    'action'     => 'index',
])->setName('tes');

return $frontend;