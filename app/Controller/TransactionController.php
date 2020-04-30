<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\TransactionService;
use App\View\View;

/**
 * Class TransactionController
 * @package App\Controller
 */
class TransactionController extends AbstractController
{
    /** @var TransactionService */
    protected TransactionService $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string[] $params
     * @throws \App\Exceptions\NotFoundException
     */
    public function index(array $params = []): void
    {
        (new View())->render('transaction', \array_merge([
            'currentValue' => $this->service->getCurrentBalance(), $params
        ]));
    }

    /**
     * pay for something, lose your money
     *
     * @throws \App\Exceptions\NotFoundException
     */
    public function withdrawal(): void
    {
        if (!$this->validate($_REQUEST, ['value' => 'required'])) {
            $this->index(['error' => 'you should fill value']);
        }

        if ($this->service->withdrawal($_REQUEST['value'])) {
            header('Location: /');
        } else {
            $this->index(['error' => 'something went wrong']);
        }
    }
}
