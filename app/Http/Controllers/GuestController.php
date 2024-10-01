<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Guest;
use Illuminate\Http\Request;
use App\Models\AccommodationDetails;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('guests.view');

        $guests = Guest::with('identity')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view("pages.guests.index", ['guests' => $guests, 'x'=>$x]);
    }

    /**
     * Display a listing of daily resource.
     */
    public function daily()
    {
        $this->authorize('guests.daily');
        $day =  Carbon::now()->day;
        $accommodation_details = AccommodationDetails::whereDay('created_at', $day)->with('guest.identity', 'firearm', 'accommodation.room.hotel:id,trade_name', 'accommodation.hotel_receptionist.identity')->get();
        
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);
        return view("pages.guests.today", ['accommodation_details' => $accommodation_details, 'x'=>$x]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('guests.view');

        $request = request();
        $request->validate([
            'id' => ['required', 'exists:guests,id'],
        ]);
        $guest = Guest::findOrFail($id)->load('identity');
        $accommodation_details = AccommodationDetails::where('guest_id', $guest->id)->with('firearm', 'accommodation.room.hotel:id,trade_name')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view("pages.guests.show", [
            'guest' => $guest,
            'accommodation_details' => $accommodation_details,
            'x'=>$x,
        ]);
    }

    public function report()
    {
        $this->authorize('guests.report');

        $request = request();
        $guests = AccommodationDetails::with('guest.identity', 'firearm', 'accommodation.room.hotel:id,trade_name', 'accommodation.hotel_receptionist.identity')->filter($request->all())->get();
        $hotels = Hotel::where('status', '<>', 'inactive')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view("pages.reports.guests", ['guests' => $guests , 'x' => $x, 'hotels'=> $hotels]);
    }
}
