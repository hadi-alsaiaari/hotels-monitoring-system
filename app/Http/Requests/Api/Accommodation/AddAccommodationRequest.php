<?php

namespace App\Http\Requests\Api\Accommodation;

use App\Models\HotelReceptionist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddAccommodationRequest extends FormRequest
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
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bookingId' => 'required|string|max:255',
            'roomNumber' => 'required|numeric',
            'numberPermit' => 'nullable|exists:residential_permits,number_permit',
            'price' => 'required|numeric',
            'arrivalAt' => 'required|date',
            'expectedDepartureTime' => 'required|date',
            'notice' => 'nullable|string',
            
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
