<?php

namespace App\Actions\Fortify;

use App\Models\TouristPolice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class SCreateNewTouristPolice implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered TouristPolice.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): TouristPolice
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(TouristPolice::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return TouristPolice::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
