<?php

return [

    'defaults' => [
        'guard' => 'user',
        'passwords' => 'users',
    ],

    'guards' => [
        'user' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        
        'estate' => [
            'driver' => 'session',
            'provider' => 'estates',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        'estates' => [
            'driver' => 'eloquent',
            'model' => App\Estate::class,
        ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        
        'estates' => [
            'provider' => 'estates',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],


    'password_timeout' => 10800,

];
