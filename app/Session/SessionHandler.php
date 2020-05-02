<?php

declare(strict_types=1);

namespace App\Session;

/**
 * Class SessionHandler
 * @package App\Session
 */
class SessionHandler
{
    /**
     * @return int
     */
    public static function getUserId(): int
    {
        session_start();
        $userId = $_SESSION['user_id'];
        session_write_close();
        return (int) $userId;
    }

    /**
     * @param int $userId
     */
    public static function setUserId(int $userId): void
    {
        session_start();
        $_SESSION['user_id'] = $userId;
        session_write_close();
    }
}
