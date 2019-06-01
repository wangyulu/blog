<?php

return [
    'common_db' => [
        'driver'    => 'mysql',
        'host'      => env('DB_COMMON_HOST', 'localhost'),
        'port'      => env('DB_COMMON_PORT', 3306),
        'database'  => env('DB_COMMON_DATABASE', 'forge'),
        'username'  => env('DB_COMMON_USERNAME', 'forge'),
        'password'  => env('DB_COMMON_PASSWORD', ''),
        'charset'   => env('DB_COMMON_CHARSET', 'utf8mb4'),
        'collation' => env('DB_COMMON_COLLATION', 'utf8mb4_unicode_ci'),
        'prefix'    => env('DB_COMMON_PREFIX', ''),
    ],
];
