<?php

declare(strict_types=1);

namespace App\Controller\Factory;

use App\Controller\TransactionController;
use App\Service\TransactionService;

/**
 * Class TransactionControllerFactory
 * @package App\Controller\Factory
 */
class TransactionControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     * @return TransactionController
     */
    public static function factory(): TransactionController
    {
        return new TransactionController(new TransactionService());
    }
}
