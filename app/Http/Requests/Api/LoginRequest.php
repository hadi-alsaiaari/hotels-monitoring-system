<?php

namespace App\Http\Requests\Api;

use App\Models\HotelUser;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'bail',
                'required',
                'string',
                'email',
                'exists:hotel_users,email',
                function($attribute, $value, $fails) {
                    $user = HotelUser::where('email', $value)->first();
                    if ($user->user_of_hotel_type !== 'App\Models\HotelReceptionist') {
                        $fails('Unauthorized to this action!');
                    }
                }
            ],
            'password' => [
                'required',
                'string',
                'min:8'
            ],
        ];
    }
}
