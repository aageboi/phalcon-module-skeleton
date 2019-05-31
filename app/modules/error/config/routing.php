<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

$error = new RouterGroup([
    'module' => 'error',
    'namespace' => 'PhalconApp\Error\Controllers'
]);

$error->addGet('/page-not-found', 'Index::show404')
    ->setName('page-not-found');

return $error;