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
        'connection' => 'mysql:host=172.18.0.2',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]

];