<?php

declare(strict_types=1);

session_start();
session_write_close();

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/bootstrap/bootstrap.php';
