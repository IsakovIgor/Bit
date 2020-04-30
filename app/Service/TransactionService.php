<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\AccountEntity;

/**
 * Class TransactionService
 * @package App\Service
 */
class TransactionService extends AbstractService
{
    protected AccountEntity $account;

    public function __construct()
    {
        $db = self::getParams();
        try {
            $this->account = new AccountEntity(new \PDO($db['dsn'], $db['login'], $db['password']));
        } catch (\PDOException $e) {
            // @todo handle
            var_dump($e->getMessage());
        }
    }

    /**
     * @return float
     */
    public function getCurrentBalance(): float
    {
        $account = $this->account->findByUserId((int) $_SESSION['user_id']);
        return (float) $account->balance;
    }

    /**
     * @param float $value
     * @return bool
     */
    public function withdrawal($value): bool
    {
        if (isset($_SESSION['user_id']) && $value > 0) {
            return $this->account->withdrawal($_SESSION['user_id'], (float) $value);
        }

        return false;
    }
}
