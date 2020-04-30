<?php


namespace App\Entity;

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
     */
    public function findByUserId(int $userId)
    {
        $stmt = $this->dm->prepare('SELECT * FROM accounts WHERE user_id = :id');
        $stmt->execute(['id' => $userId]);
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * @param int $userId
     * @param float $value
     * @return bool
     */
    public function withdrawal(int $userId, float $value): bool
    {
        try {
            $this->dm->beginTransaction();

            $stmt = $this->dm->prepare('SELECT * FROM accounts WHERE user_id = :id FOR UPDATE');
            $stmt->execute(['id' => $userId]);
            /** @var AccountEntity $account */
            $account = $stmt->fetch(\PDO::FETCH_OBJ);

            if ($account->balance > 0) {
                $stmt = $this->dm->prepare('UPDATE accounts SET balance = :balance WHERE user_id = :id');
                $stmt->execute(['id' => $userId, 'balance' => $account->balance - $value]);
            }

            $this->dm->commit();
            return true;
        } catch (\PDOException $e) {
            $this->dm->rollBack();
            // @todo handle
            var_dump($e->getMessage());
        }

        return false;
    }
}
