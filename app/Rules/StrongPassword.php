<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Kiểm tra độ dài tối thiểu
        if (strlen($value) < 8) {
            $fail('Mật khẩu phải có ít nhất 8 ký tự.');
            return;
        }

        // Kiểm tra không được toàn là số
        if (preg_match('/^[0-9]+$/', $value)) {
            $fail('Mật khẩu không được toàn là số.');
            return;
        }

        // Kiểm tra phải có ít nhất 1 chữ cái
        if (!preg_match('/[a-zA-Z]/', $value)) {
            $fail('Mật khẩu phải chứa ít nhất 1 chữ cái.');
            return;
        }
    }
}
