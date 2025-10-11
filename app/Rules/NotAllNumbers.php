<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotAllNumbers implements Rule
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
        // Name must be at least 3 characters
        if (strlen(trim($value)) < 3) {
            return false;
        }

        // Name cannot contain spaces
        if (preg_match('/\s/', $value)) {
            return false;
        }

        // Name cannot contain any numbers
        if (preg_match('/[0-9]/', $value)) {
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
        return 'Họ và tên phải có ít nhất 3 ký tự, không được chứa số và khoảng trắng.';
    }
}
