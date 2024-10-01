<?php

namespace App\Http\Controllers;

use App\Events\HotelOpeningRequest;
use App\Services\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class MoreOneHotelController extends Controller
{
    public function index()
    {
        return view('hotels.pages.create_new_hotel');
    }
    public function createAnotherHotel()
    {
        $request = request();
        
        $request->validate([            
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
            'operator_management'=> ['nullable', 'string', 'max:255'],
            'number_of_employees'=> ['required', 'numeric', 'max:255', 'gte:yemeni_employee'],
            'yemeni_employee'=> ['required', 'numeric', 'max:255', 'lte:number_of_employees'],
            'commercial_record'=> ['required', 'mimes:pdf', 'max:5150'],
            'building_property'=> ['required', 'mimes:pdf', 'max:5150'],
            'personal_card'=> ['required', 'mimes:pdf', 'max:5150'],
            'hotel_phone_number'=> ['required', 'string', 'max:30'],
        ]);
        
        $user = Auth::user();
        $hotel_owner = $user->user_of_hotel;

        DB::beginTransaction();
        try {
            $commercial_record = UploadFile::newUploadFile($request, 'commercial_record');
            $building_property = UploadFile::newUploadFile($request, 'building_property');
            $personal_card = UploadFile::newUploadFile($request, 'personal_card');

            $hotel = $hotel_owner->hotels()->create([
                'hotel_email' => $request['hotel_email'],
                'trade_name' => $request['trade_name'],
                'name_owner_building' => $request['name_owner_building'],
                'situation' => $request['situation'],
                'website' => $request['website'],
                'hotel_governorate' => $request['hotel_governorate'],
                'hotel_directoration' => $request['hotel_directoration'],
                'hotel_city' => $request['hotel_city'],
                'hotel_street_address' => $request['hotel_street_address'],
                'operator_management' => $request['operator_management'],
                'number_of_employees' => $request['number_of_employees'],
                'yemeni_employee' => $request['yemeni_employee'],
                'commercial_record'=> $commercial_record,
                'building_property'=> $building_property,
                'personal_card' => $personal_card,
            ]);
            
            $hotel->phone_numbers()->create([
                'phone_number' => $request['hotel_phone_number'],
            ]);

            DB::commit();

            event(new HotelOpeningRequest($hotel));
            
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('instanc', $hotel);
    }

    public function changeHotel(Request $request)
    {
        $request->validate([
                'hotel_id' => ['required', 'exists:hotels,id'],
        ]);

        $user = Auth::user();
        $hotel_owner = $user->user_of_hotel;
        $hotel_owner->hotel_id = $request->hotel_id;
        $hotel_owner->save();
        return redirect()->route('dashboard_h');
    }
}
