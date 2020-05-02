<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\AccountEntity;
use App\Exceptions\UserHasNotAuthException;
use App\Session\SessionHandler;

/**
 * Class TransactionService
 * @package App\Service
 */
class TransactionService
{
    protected AccountEntity $account;

    public function __construct()
    {
        $this->account = new AccountEntity();
    }

    /**
     * @return float
     * @throws UserHasNotAuthException
     */
    public function getCurrentBalance(): float
    {
        $account = $this->account->findByUserIdOrFail(SessionHandler::getUserId());
        return (float) $account->balance;
    }

    /**
     * @param float $value
     * @return bool
     */
    public function withdrawal($value): bool
    {
        $userId = SessionHandler::getUserId();
        if (!empty($userId) && $value > 0) {
            return $this->account->withdrawal($userId, (float) $value);
        }

        return false;
    }
}
