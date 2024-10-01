<?php

namespace App\Services\Validations;

class CreateIdentityValidator
{
    public static function rules($request)
    {
            $request->validate([
            'identity_number' => ['required', 'string', 'max:100'],
            'first_name' => ['required', 'string', 'max:50'],
            'second_name' => ['required', 'string', 'max:50'],
            'third_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'country' => ['required', 'string', 'min:2', 'max:2'],
            'place_of_birth' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'sex' => ['required', 'string', 'in:male,female'],
            'date_of_issue' => ['required', 'date'],
            'date_of_expiry' => ['required', 'date'],
            'issuing_authority' => ['required', 'string', 'max:100'],
            'identity_type' => ['required', 'string', 'max:100'],
        ]);
    }
}
