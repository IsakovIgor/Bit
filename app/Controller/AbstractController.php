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
     * @param string[] $values
     * @return bool
     */
    protected function validate(array $request, array $values = []): bool
    {
        foreach ($values as $key => $value) {
            /*
             * $key is some field from request, e.g. email
             * $value is names of rules for this field, e.g. required|email|unique
             */
            $rules = \explode('|', $value);

            foreach ($rules as $rule) {
                switch ($rule) {
                    case 'required':
                        if (!\array_key_exists($key, $request) || empty($request[$key])) {
                            return false;
                        }
                        break;
                    case 'positive':
                        if ($request[$key] < 0.001) {
                            return false;
                        }
                    default:
                }
            }
        }

        return true;
    }
}
