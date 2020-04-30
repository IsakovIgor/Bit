<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AuthService;
use App\View\View;

/**
 * Class AuthController
 * @package App\Controller
 */
class AuthController extends AbstractController
{
    /** @var AuthService */
    protected AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @param array $params
     * @throws \App\Exceptions\NotFoundException
     */
    public function index(array $params = []): void
    {
        (new View)->render('auth', $params);
    }

    /**
     * @throws \App\Exceptions\NotFoundException
     */
    public function auth(): void
    {
        if (!$this->validate($_REQUEST, ['email' => 'required', 'password' => 'required'])) {
            $this->index(['error' => 'you should fill all fields']);
        }

        if (!$this->service->auth($_REQUEST)) {
            $this->index(['error' => 'invalid email or password']);
        } else {
            header('Location: /');
        }
    }
}
