<?php

return [

    /**
     * Application settings
     */
    'application' => [
        /**
         * The site name, you should change it to your name website
         */
        'name' => 'Phalcon Module Skeleton',
        'publicUrl' => env('APP_URL'),

        /**
         * Please don't change it
         */
        'httpStatusCode' => 200, // 503
        'modelsDir'      => app_path('app/common/models/'),
        'baseUri'        => 'http://localhost:8000',
        'view' => [
            'viewsDir'          => app_path('views/'),
            'compiledPath'      => content_path('cache/'),
            'compiledSeparator' => '_',
            'compiledExtension' => '.php',
            'paginator'         => [
                'limit' => 10,
            ],
        ],

        /**
         * For developers: debugging mode.
         *
         * Change this to true to enable the display of notices during development.
         * It is strongly recommended that plugin and theme developers use
         * in their development environments.
         */
        'debug' => TRUE,

        /**
         * You can see from
         *
         * @link https://docs.phalconphp.com/en/latest/reference/logging.html
         */
        'logger' => [
            'path'   => content_path('logs/'),
            'format' => '[%date%][%type%] %message%',
            'level'  => 'debug',
        ],
    ]
];