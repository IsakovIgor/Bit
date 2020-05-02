<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Session\SessionHandler;

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
        $userId = SessionHandler::getUserId();
        if (!$userId || $userId < 1) {
            header('Location: /auth');
        }
    }
}
