<?php


return [
    'default' => 'mongodb',

    'connections' => [
        'mongodb' => [
            'driver' => 'mongodb',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => '27017',
            'database' => 'vesal_profiles_ms',
            'username' => '',
            'password' => '',
//            'dsn' => env('DB_URI', 'homestead'),
        ],


    ]
];
