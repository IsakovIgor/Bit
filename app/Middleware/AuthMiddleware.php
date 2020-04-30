<?php

declare(strict_types=1);

namespace App\Middleware;

/**
 * Class AuthMiddleware
 * @package App\Middleware
 */
class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @inheritDoc
     */
    public static function handle(array $request): void
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] < 1) {
            header('Location: /auth');
        }
    }
}
