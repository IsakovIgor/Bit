<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\UserEntity;

/**
 * Class AbstractService
 * @package App\Service
 */
abstract class AbstractService
{
    protected static function getParams()
    {
        $db = $_ENV['database'];
        return [
            'dsn' => "{$db['type']}:host={$db['host']};port={$db['port']};dbname={$db['name']}",
            'login' => $db['login'],
            'password' => $db['password']
        ];
    }
}
