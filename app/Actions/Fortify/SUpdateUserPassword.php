<?php

namespace App\Actions\Fortify;

use App\Models\TourismOffice;
use App\Models\TouristPolice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class SUpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update($user, array $input): void
    {
        if($user instanceof TouristPolice){
            Validator::make($input, [
                'current_password' => ['required', 'string', 'current_password:tourist_police'],
                'password' => $this->passwordRules(),
            ], [
                'current_password.current_password' => __('The provided password does not match your current password.'),
            ])->validateWithBag('updatePassword');
        }
        elseif($user instanceof TourismOffice){
            Validator::make($input, [
                'current_password' => ['required', 'string', 'current_password:tourism_office'],
                'password' => $this->passwordRules(),
            ], [
                'current_password.current_password' => __('The provided password does not match your current password.'),
            ])->validateWithBag('updatePassword');
        } else {
            Validator::make($input, [
                'current_password' => ['required', 'string', 'current_password:security_department_office'],
                'password' => $this->passwordRules(),
            ], [
                'current_password.current_password' => __('The provided password does not match your current password.'),
            ])->validateWithBag('updatePassword');
        }

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
