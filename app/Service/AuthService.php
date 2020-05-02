<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\UserEntity;
use App\Session\SessionHandler;

/**
 * Class AuthService
 * @package App\Service
 */
class AuthService
{
    protected UserEntity $userEntity;

    public function __construct()
    {
        $this->userEntity = new UserEntity();
    }

    public function auth(array $request): bool
    {
        $user = $this->userEntity->findByEmail($request['email']);
        if (!$this->validate($request['password'], $user)) {
            return false;
        }

        SessionHandler::setUserId($user->id);

        return true;
    }

    /**
     * @param string $password
     * @param UserEntity $user
     * @return bool
     */
    public function validate(string $password, $user): bool
    {
        return \password_verify($password, $user->password);
    }
}
