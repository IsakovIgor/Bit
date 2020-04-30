<?php

declare(strict_types=1);

namespace App\Router;

use App\Controller\AbstractController;
use App\Controller\Factory\FactoryInterface;
use App\Middleware\MiddlewareInterface;

/**
 * Class Router
 * @package App\Router
 */
class Router
{
    /**
     * GET method
     *
     * @param string $route
     * @param string $factory
     * @param string $method
     * @param array $middlewares
     */
    public static function get(string $route, string $factory, string $method, array $middlewares = []): void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        self::on($route, $factory, $method, $middlewares);
    }

    /**
     * POST method
     *
     * @param string $route
     * @param string $factory
     * @param string $method
     * @param array $middlewares
     */
    public static function post(string $route, string $factory, string $method, array $middlewares = []): void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        self::on($route, $factory, $method, $middlewares);
    }

    /**
     * @param string $route
     * @param string $factory
     * @param string $method
     * @param MiddlewareInterface[] $middlewares
     * @return mixed
     */
    public static function on(string $route, string $factory, string $method, array $middlewares)
    {
        /** @var FactoryInterface $factory */
        if ($route === $_SERVER['REQUEST_URI']) {
            foreach ($middlewares as $middleware) {
                $middleware::handle($_REQUEST);
            }

            return ($factory::factory())->$method();
        }
    }
}
