<?php

declare(strict_types=1);

namespace App\View;

use App\Exceptions\NotFoundException;

/**
 * Class View
 * @package App\View
 */
class View
{
    /**
     * render template with variables
     *
     * @param string $route
     * @param array $params
     * @throws NotFoundException
     */
    public function render(string $route, array $params = []): void
    {
        if (file_exists(__DIR__ . "/../Resources/views/$route.php") === false) {
            throw new NotFoundException('view is not found');
        }

        \extract($params, EXTR_SKIP);
        include(__DIR__ . "/../Resources/views/$route.php");
    }
}
