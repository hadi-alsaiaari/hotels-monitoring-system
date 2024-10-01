<?php

namespace App\Http\Requests\Api\Accommodation;

use App\Models\HotelReceptionist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddGuestRequest extends FormRequest
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
            'expectedDepartureTime' => 'required|date',
            'arrivalAt' => 'required|date',
            
            'bookingDetailsId.*' => 'required|string|max:255',
            'guests.*.identityNumber' => 'required|string|max:100',
            'guests.*.firstName' => 'required|string|max:50',
            'guests.*.secondName' => 'required|string|max:50',
            'guests.*.thirdName' => 'required|string|max:50',
            'guests.*.lastName' => 'required|string|max:50',
            'guests.*.country' => 'required|string|min:2|max:2',
            'guests.*.placeOfBirth' => 'nullable|string|max:255',
            'guests.*.dateOfBirth' => 'nullable|date',
            'guests.*.sex' => 'required|string|in:male,female',
            'guests.*.dateOfIssue' => 'nullable|date',
            'guests.*.dateOfExpiry' => 'nullable|date',
            'guests.*.issuingAuthority' => 'nullable|string|max:100',
            'guests.*.identityType' => 'required|string|max:100',

            'firearms.*.firearmSerialNumber' => 'required_with:firearms.*.firearmType|string|max:255',
            'firearms.*.firearmType' => 'required_with:firearms.*.firearmSerialNumber|string|max:255',
            'firearms.*.licenseType' => 'nullable|string|max:255',
            'firearms.*.licenseNumber' => 'nullable|int',
            'guestsHaveFirearm' => 'required_with:firearms|array',
            'guestsHaveFirearm.*' => 'nullable|int',
        ];
    }
}
