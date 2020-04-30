<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Class AbstractController
 * @package App\Controller
 */
abstract class AbstractController
{
    /**
     * Validation request ("required" rule allowed only)
     *
     * @todo add new rules
     *
     * @param array $request
     * @param string[] $rules
     * @return bool
     */
    protected function validate(array $request, array $rules = []): bool
    {
        foreach ($rules as $key => $rule) {
            if (!\array_key_exists($key, $request) || empty($request[$key])) {
                return false;
            }
        }

        return true;
    }
}
