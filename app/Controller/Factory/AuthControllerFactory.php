<?php

declare(strict_types=1);

namespace App\Controller\Factory;

use App\Controller\AuthController;
use App\Service\AuthService;

/**
 * Class AuthControllerFactory
 * @package App\Controller\Factory
 */
class AuthControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     * @return AuthController
     */
    public static function factory(): AuthController
    {
        return new AuthController(new AuthService());
    }
}
