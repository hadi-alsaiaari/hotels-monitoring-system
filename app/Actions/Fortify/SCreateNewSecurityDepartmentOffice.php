<?php

namespace App\Actions\Fortify;

use App\Models\SecurityDepartmentOffice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class SCreateNewSecurityDepartmentOffice implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered SecurityDepartmentOffice.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): SecurityDepartmentOffice
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(SecurityDepartmentOffice::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return SecurityDepartmentOffice::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
