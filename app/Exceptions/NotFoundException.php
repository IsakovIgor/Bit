<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * Class NotFoundException
 * @package App\Exceptions
 */
class NotFoundException extends \Exception
{
    public function __construct($message)
    {
        var_dump($message);
        parent::__construct($message, 404);
    }
}
