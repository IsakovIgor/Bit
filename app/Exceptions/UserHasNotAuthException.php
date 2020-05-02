<?php

declare(strict_types=1);

namespace App\Exceptions;

/**
 * Class UserHasNotAuthException
 * @package App\Exceptions
 */
class UserHasNotAuthException extends \Exception
{
    public function __construct()
    {
        // @todo something
        header('Location: /auth');
        parent::__construct();
    }
}
