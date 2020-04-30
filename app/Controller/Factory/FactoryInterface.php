<?php

declare(strict_types=1);

namespace App\Controller\Factory;

use App\Controller\AbstractController;

/**
 * Interface FactoryInterface
 * @package App\Controller\Factory
 */
interface FactoryInterface
{
    /**
     * let's make something pretty
     *
     * @return AbstractController
     */
    public static function factory();
}
