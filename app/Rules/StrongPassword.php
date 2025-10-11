<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Password must be at least 8 characters
        if (strlen($value) < 8) {
            return false;
        }

        // Password cannot contain spaces
        if (preg_match('/\s/', $value)) {
            return false;
        }

        // Password must contain at least one letter
        if (!preg_match('/[a-zA-Z]/', $value)) {
            return false;
        }

        // Password must contain at least one special character
        if (!preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]/', $value)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ cái và ký tự đặc biệt, không được chứa khoảng trắng.';
    }
}
