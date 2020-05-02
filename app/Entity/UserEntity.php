<?php

declare(strict_types=1);

namespace App\Entity;

/**
 * Class UserEntity
 * @package App\Entity
 *
 * @property int    $id
 * @property string $email
 * @property string $password
 */
class UserEntity extends AbstractEntity
{
    /**
     * @param string $email
     * @return mixed
     */
    public function findByEmail(string $email)
    {
        return $this->dm->select('SELECT * FROM users WHERE email = :email', ['email' => $email]);
    }
}
