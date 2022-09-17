<?php

return [
    'profiles' => [
        'base_uri' => env('PROFILES_SERVICE_BASE_URI'),
        'secret' => env('PROFILES_SERVICE_SECRET')
    ],
    'users' => [
        'base_uri' => env('AUTH_SERVICE_BASE_URI'),
        'secret' => env('AUTH_SERVICE_SECRET'),
    ]
];
