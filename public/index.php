<?php

/**
 * Include Autoloader
 */
require __DIR__.'/../app/config/loader.php';

$app = new PhalconApp\Common\Application();
echo $app->run();
die;