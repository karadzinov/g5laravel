<?php

namespace App\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordInt implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (!is_int($value)) {
            $fail('Полето :attribute мора да е бројка.');
        }
    }
}
