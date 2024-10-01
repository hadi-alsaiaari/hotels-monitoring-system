<?php

namespace App\Actions\Fortify\HotelUser;

use App\Events\HotelOpeningRequest;
use App\Models\HotelOwner;
use App\Models\HotelUser;
use App\Models\Identity;
use App\Services\UploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Throwable;

class CreateNewHotelOwner implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered HotelUser.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): HotelUser
    {
        $request = request();
        
        Validator::make($input, [
            'identity_number' => ['required', 'string', 'max:100'],
            'first_name'=> ['required', 'string', 'max:50'],
            'second_name'=> ['required', 'string', 'max:50'],
            'third_name'=> ['required', 'string', 'max:50'],
            'last_name'=> ['required', 'string', 'max:50'],
            'country'=> ['required', 'string', 'min:2', 'max:2'],
            'place_of_birth'=> ['required', 'string', 'max:255'],
            'date_of_birth'=> ['required', 'date', 'before_or_equal:' . now()->subRealYears(18)],
            'sex'=> ['required', 'string', 'in:male,female'],
            'date_of_issue'=> ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d'), 'before_or_equal:' . now()->setDateFrom($request->date_of_expiry)->subRealYear()],
            'date_of_expiry'=> ['required', 'date', 'after_or_equal:' . now()->format('Y-m-d'), 'after_or_equal:' . now()->setDateFrom($request->date_of_issue)->addRealYear()],
            'issuing_authority'=> ['required', 'string', 'max:100'],
            'identity_type'=> ['required', 'string', 'max:100'],
            
            'governorate'=> ['required', 'string', 'max:255'],
            'city'=> ['required', 'string', 'max:255'],
            'street_address'=> ['required', 'string', 'max:255'],
            'personal_photo' => ['required', 'image:png', 'max:5150'],
            
            'phone_number'=> ['required', 'string', 'max:30'],
            'hotel_phone_number'=> ['required', 'string', 'max:30'],
            
            'hotel_email'=> ['required', 'string', 'max:255', 'email', 'unique:hotels,hotel_email'],
            'trade_name'=> ['required', 'string', 'max:255', 'unique:hotels,trade_name'],
            'name_owner_building'=> ['required', 'string', 'max:255'],
            'situation'=> ['required', 'string', 'in:single,branch,main_center'],
            'website'=> ['nullable', 'string', 'max:255'],
            'hotel_governorate'=> ['required', 'string', 'max:255'],
            'hotel_directoration'=> ['required', 'string', 'max:255'],
            'hotel_city'=> ['required', 'string', 'max:255'],
            'hotel_street_address'=> ['required', 'string', 'max:255'],
            'fax' => ['nullable', 'string', 'max:255'],
            'operator_management'=> ['required', 'string', 'max:255'],
            'number_of_employees'=> ['required', 'numeric', 'max:255', 'gte:yemeni_employee'],
            'yemeni_employee'=> ['required', 'numeric', 'max:255', 'lte:number_of_employees'],
            'commercial_record'=> ['required', 'mimes:pdf', 'max:5150'],
            'building_property'=> ['required', 'mimes:pdf', 'max:5150'],
            'personal_card'=> ['required', 'mimes:pdf', 'max:5150'],
            
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(HotelUser::class),
                
            ],
            'password' => $this->passwordRules(),
        ])->validate();
        // $check = Identity::checkGuestIdentity($request->date_of_birth, $request->date_of_issue, $request->date_of_expiry);
        // if ($check != 1) {

        //     return new HotelUser();
        // }
        DB::beginTransaction();
        try {
            $personal_photo = UploadFile::newUploadFile($request, 'personal_photo', 'image');
            $commercial_record = UploadFile::newUploadFile($request, 'commercial_record');
            $building_property = UploadFile::newUploadFile($request, 'building_property');
            $personal_card = UploadFile::newUploadFile($request, 'personal_card');

            $hotel_owner = HotelOwner::create([
                'street_address' => $input['street_address'],
                'city' => $input['city'],
                'governorate' => $input['governorate'],
                'personal_photo' => $personal_photo,
            ]);
            
            $hotel_owner->phone_numbers()->create([
                'phone_number' => $input['phone_number'],
            ]);
            $hotel_user = $hotel_owner->hotel_user()->create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            $hotel_owner->identity()->create([
                'identity_number' => $input['identity_number'],
                'first_name' => $input['first_name'],
                'second_name' => $input['second_name'],
                'third_name' => $input['third_name'],
                'last_name' => $input['last_name'],
                'country' => $input['country'],
                'place_of_birth' => $input['place_of_birth'],
                'date_of_birth' => $input['date_of_birth'],
                'sex' => $input['sex'],
                'date_of_issue' => $input['date_of_issue'],
                'date_of_expiry' => $input['date_of_expiry'],
                'issuing_authority' => $input['issuing_authority'],
                'identity_type' => $input['identity_type'],
            ]);

            $hotel = $hotel_owner->hotels()->create([
                'hotel_email' => $input['hotel_email'],
                'trade_name' => $input['trade_name'],
                'name_owner_building' => $input['name_owner_building'],
                'situation' => $input['situation'],
                'website' => $input['website'],
                'hotel_governorate' => $input['hotel_governorate'],
                'hotel_directoration' => $input['hotel_directoration'],
                'hotel_city' => $input['hotel_city'],
                'hotel_street_address' => $input['hotel_street_address'],
                'operator_management' => $input['operator_management'],
                'number_of_employees' => $input['number_of_employees'],
                'yemeni_employee' => $input['yemeni_employee'],
                'commercial_record'=> $commercial_record,
                'building_property'=> $building_property,
                'personal_card' => $personal_card,
            ]);
            
            $hotel->phone_numbers()->create([
                'phone_number' => $input['hotel_phone_number'],
            ]);

            $hotel_owner->update([
                'hotel_id' => $hotel->id,
            ]);
            
            DB::commit();

            event(new HotelOpeningRequest($hotel));
            
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $hotel_user;
    }
}
