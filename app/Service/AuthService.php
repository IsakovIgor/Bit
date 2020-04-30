<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\UserEntity;

/**
 * Class AuthService
 * @package App\Service
 */
class AuthService extends AbstractService
{
    protected UserEntity $userEntity;

    public function __construct()
    {
        $db = self::getParams();
        try {
            $this->userEntity = new UserEntity(new \PDO($db['dsn'], $db['login'], $db['password']));
        } catch (\PDOException $e) {
            // @todo handle
            var_dump($e->getMessage());
        }
    }

    public function auth(array $request): bool
    {
        $user = $this->userEntity->findByEmail($request['email']);
        if (!$this->validate($request['password'], $user)) {
            return false;
        }

        $_SESSION['user_id'] = $user->id;

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
