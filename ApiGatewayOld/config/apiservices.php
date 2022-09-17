<?php

return [
    'profiles' => [
        'base_uri' => env('PROFILES_SERVICE_BASE_URI'),
        'secret' => env('PROFILES_SERVICE_SECRET')
    ],
    'users' => [
        'base_uri' => env('USERS_SERVICE_BASE_URI'),
        'secret' => env('USERS_SERVICE_SECRET'),
    ]
];
