<?php

use Phalcon\Loader;

// Load constants
require 'constants.php';
require ROOT_DIR . '/vendor/autoload.php';

(new Loader)
    ->registerNamespaces([
        'PhalconApp\Common' => ROOT_DIR . '/app/common/',
        'PhalconApp\Common\Library' => ROOT_DIR . '/app/common/library/',
        'PhalconApp\Controllers' => ROOT_DIR . '/app/common/controllers/',
    ])
    ->registerFiles([
        __DIR__ . '/helpers.php'
    ])
    ->register();