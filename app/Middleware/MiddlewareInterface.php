<?php

declare(strict_types=1);

namespace App\Middleware;

/**
 * Interface MiddlewareInterface
 * @package App\Middleware
 */
interface MiddlewareInterface
{
    /**
     * @param array $request
     * @return mixed
     */
    public static function handle(array $request): void;
}
