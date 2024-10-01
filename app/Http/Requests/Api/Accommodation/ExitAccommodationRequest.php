<?php

namespace App\Http\Requests\Api\Accommodation;

use App\Models\HotelReceptionist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExitAccommodationRequest extends FormRequest
{
    protected $user;

    public function __construct() {
        $this->user = Auth::guard('sanctum')->user();
    }
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->user->user_of_hotel_type == HotelReceptionist::class) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hotelSystemBookingId' => 'required|string|max:255',
            'roomNumber' => 'required|numeric',
        ];
    }
}
