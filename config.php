<?php

return [

    // set some application paths
    'path' => [
        'root' => __DIR__
    ],

    // set default middlewares
    'middlewares' => [
        'authMiddleware'
    ],

    // set database info
    'database' => [
        'name' => 'viking',
        'username' => 'root',
        'password' => '123456',
        'connection' => 'mysql:host=viking-mysql',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]

];