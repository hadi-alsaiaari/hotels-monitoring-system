<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Hotel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\AccommodationDetails;
use App\Models\ResidentialPermit;
use App\Models\Tax;
use Illuminate\Support\Facades\Auth;

class AccommodationController extends Controller
{
    public function indexOnHotel()
    {
        $user = request()->user();
        $hotel_user = $user->user_of_hotel()->first();
        if ($user->user_of_hotel_type == 'App\Models\HotelOwner') {
            $hotel = $hotel_user->hotel();
        } else {
            $hotel = $hotel_user->hotel;
        }
        $request = request();
        $request->merge([
            'hotel_id' => $hotel->id,
        ]);
        $accommodations = Accommodation::with('room.hotel:id,trade_name', 'residential_permit', 'hotel_receptionist.identity')->filter($request->all())->withCount('accommodation_details')->get();

        return view("hotels.accommodations.index", ['accommodations' => $accommodations]);
    }
    
    public function dailyOnHotel()
    {
        $user = request()->user();
        $hotel_user = $user->user_of_hotel()->first();
        if ($user->user_of_hotel_type == 'App\Models\HotelOwner') {
            $hotel = $hotel_user->hotel();
        } else {
            $hotel = $hotel_user->hotel;
        }
        $request = request();
        $request->merge([
            'hotel_id' => $hotel->id,
        ]);
        $day =  Carbon::now()->day;
        $accommodations = Accommodation::whereDay('created_at', $day)->with('room.hotel:id,trade_name', 'residential_permit', 'hotel_receptionist.identity')->filter($request->all())->withCount('accommodation_details')->get();
        // $accommodations = Accommodation::with('room.hotel:id,trade_name', 'residential_permit', 'hotel_receptionist.identity')->filter($request->all())->withCount('accommodation_details')->get();

        return view("hotels.accommodations.index", ['accommodations' => $accommodations]);
    }

    public function showOnHotel($id)
    {
        $request = request();
        $request->validate([
            'id' => ['required', 'exists:accommodations,id'],
        ]);
        $accommodation = Accommodation::findOrFail($id)->load('room.hotel', 'residential_permit', 'hotel_receptionist.identity');
        $accommodation_details = AccommodationDetails::where('accommodation_id', $accommodation->id)->with('guest.identity', 'firearm')->get();

        return view("hotels.accommodations.show", [
            'accommodation' => $accommodation,
            'accommodation_details' => $accommodation_details,
        ]);
    }

    
    public function index()
    {
        $this->authorize('accommodations.view');

        $accommodations = Accommodation::with('room.hotel:id,trade_name', 'residential_permit', 'hotel_receptionist.identity')->withCount('accommodation_details')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view("pages.accommodations.index", ['accommodations' => $accommodations, 'x' => $x,]);
    }

    
    public function daily()
    {
        $this->authorize('accommodations.daily');

        $day =  Carbon::now()->day;
        $accommodations = Accommodation::whereDay('created_at', $day)->with('room.hotel:id,trade_name', 'residential_permit', 'hotel_receptionist.identity')->withCount('accommodation_details')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view("pages.accommodations.today", ['accommodations' => $accommodations, 'x' => $x]);
    }

    public function report()
    {
        $day = now()->day;
        $used_expired = 'used_expired';
        $not_used_expired = 'not_used_expired';
        $not_use = 'not_use';
        $used = 'used';
        $sum_on_day_taxes = Tax::whereDay('created_at', $day)->sum('tax_value');
        $sum_on_day_accommodations = Accommodation::whereDay('created_at', $day)->count();
        $sum_on_day_guests = AccommodationDetails::whereDay('created_at', $day)->count();
        $sum_on_day_firearms = AccommodationDetails::where('firearm_id', '<>', null)->whereDay('created_at', $day)->count();
        $sum_active_hotels = Hotel::where('status', '=', 'active')->count();
        $sum_inactive_hotels = Hotel::where('status', '=', 'inactive')->count();
        $sum_block_hotels = Hotel::where('status', '=', 'block')->count();
        $sum_need_renewal_hotels = Hotel::where('license', '=', 'renewal')->count();
        $sum_residential_permits = ResidentialPermit::count();
        $sum_on_day_residential_permits = ResidentialPermit::whereDay('created_at', $day)->count();
        $sum_expired_residential_permits = ResidentialPermit::whereRaw('status = ? OR status = ?', [$used_expired, $not_used_expired])->count();
        $sum_valid_residential_permits = ResidentialPermit::whereRaw('status = ? OR status = ?', [$not_use, $used])->count();

        // dd($sum_on_day_taxes, 
        //     $sum_on_day_accommodations, 
        //     $sum_on_day_guests, 
        //     $sum_on_day_firearms, 
        //     $sum_active_hotels, 
        //     $sum_inactive_hotels, 
        //     $sum_block_hotels, 
        //     $sum_need_renewal_hotels, 
        //     $sum_residential_permits, 
        //     $sum_on_day_residential_permits, 
        //     $sum_expired_residential_permits, 
        //     $sum_valid_residential_permits
        // );
        $this->authorize('accommodations.report');

        $request = request();
        $accommodations = Accommodation::with('room.hotel:id,trade_name', 'residential_permit', 'hotel_receptionist.identity')->filter($request->all())->withCount('accommodation_details')->get();
        $hotels = Hotel::where('status', '<>', 'inactive')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view("pages.reports.accommodations", ['accommodations' => $accommodations, 'x' => $x, 'hotels' => $hotels]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('accommodations.view');

        $request = request();
        $request->validate([
            'id' => ['required', 'exists:accommodations,id'],
        ]);
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);
        $accommodation = Accommodation::findOrFail($id)->load('room.hotel', 'residential_permit', 'hotel_receptionist.identity');
        $accommodation_details = AccommodationDetails::where('accommodation_id', $accommodation->id)->with('guest.identity', 'firearm')->get();

        return view("pages.accommodations.show", [
            'accommodation' => $accommodation,
            'accommodation_details' => $accommodation_details,
            'x' => $x,
        ]);
    }
}
