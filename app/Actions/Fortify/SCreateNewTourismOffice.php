<?php

namespace App\Actions\Fortify;

use App\Models\TourismOffice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class SCreateNewTourismOffice implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered TourismOffice.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): TourismOffice
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(TourismOffice::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return TourismOffice::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
