<?php

declare(strict_types=1);

$env = file_get_contents(__DIR__ . '/../.env');
$env = \explode(';', $env);
foreach ($env as $e) {
    if (\strpos($e, '=') !== false) {
        putenv(\trim($e));
    }
}

$_ENV = require_once __DIR__ . '/../config/database.php';
