<?php

declare(strict_types=1);

return [
    'database' => [
        'type'     => getenv('DB_TYPE') !== false ? getenv('DB_TYPE') : 'mysql',
        'host'     => getenv('DB_HOST') !== false ? getenv('DB_HOST') : '127.0.0.1',
        'port'     => getenv('DB_PORT') !== false ? getenv('DB_PORT') : '3306',
        'charset'  => getenv('DB_CHARSET') !== false ? getenv('DB_CHARSET') : 'UTF8',
        'name'     => getenv('DB_NAME') !== false ? getenv('DB_NAME') : 'bit',
        'login'    => getenv('DB_LOGIN') !== false ? getenv('DB_LOGIN') : 'root',
        'password' => getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : 'root',
    ]
];
