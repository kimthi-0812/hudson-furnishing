<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class TrimmedString implements Rule
{
    public function passes($attribute, $value)
    {
        return $value === trim($value);
    }

    public function message()
    {
        return 'Không được có khoảng trắng ở đầu hoặc cuối.';
    }
}
