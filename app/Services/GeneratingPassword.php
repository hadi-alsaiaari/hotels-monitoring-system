<?php

namespace App\Services;

use Illuminate\Support\Str;

class GeneratingPassword
{
    public static function generating_password()
    {
        return Str::password();
    }
}
