<?php

declare(strict_types=1);

namespace App\Entity;

use App\Exceptions\UserHasNotAuthException;

/**
 * Class AccountEntity
 * @package App\Entity
 *
 * @property int   $id
 * @property int   $user_id
 * @property float $balance
 */
class AccountEntity extends AbstractEntity
{
    /**
     * @param int $userId
     * @return AccountEntity
     * @throws UserHasNotAuthException
     */
    public function findByUserIdOrFail(int $userId)
    {
        $account = $this->dm->select('SELECT * FROM accounts WHERE user_id = :id', ['id' => $userId]);

        if ($account === null) {
            throw new UserHasNotAuthException();
        }

        return $account;
    }

    /**
     * @param int $userId
     * @param float $value
     * @return bool
     */
    public function withdrawal(int $userId, float $value): bool
    {
        return $this->dm->transaction(function () use ($userId, $value) {
            /** @var AccountEntity $account */
            $account = $this->dm->select('SELECT * FROM accounts WHERE user_id = :id FOR UPDATE', ['id' => $userId]);

            if ($account->balance - $value > 0.001) {
                return $this->dm->update(
                    'UPDATE accounts SET balance = :balance WHERE user_id = :id',
                    ['id' => $userId, 'balance' => $account->balance - $value]
                );
            }

            return false;
        });
    }
}
