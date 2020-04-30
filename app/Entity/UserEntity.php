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
    public function findByEmail(string $email)
    {
        $stmt = $this->dm->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }
}
