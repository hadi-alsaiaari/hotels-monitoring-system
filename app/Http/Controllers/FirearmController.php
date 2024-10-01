<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Hotel;
use App\Models\Firearm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AccommodationDetails;
use Illuminate\Support\Facades\Auth;

class FirearmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('firearms.view');

        $firearms = Firearm::get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);
        return view("pages.firearms.index", ['firearms' => $firearms, 'x' => $x]);
    }

    /**
     * Display a listing of daily resource.
     */
    public function daily()
    {
        $this->authorize('firearms.daily');

        $day =  now()->day;
        $accommodation_details = AccommodationDetails::where('firearm_id', '<>', null)->whereDay('created_at', $day)->with('guest.identity', 'firearm', 'accommodation.room.hotel')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view("pages.firearms.today", ['accommodation_details' => $accommodation_details, 'x'=>$x]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('firearms.view');

        $firearm = Firearm::findOrFail($id);
        $accommodation_details = AccommodationDetails::where('firearm_id', $firearm->id)->with('guest.identity', 'accommodation.room.hotel')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view("pages.firearms.show", ['firearm' => $firearm, 'accommodation_details' => $accommodation_details, 'x' =>$x]);
    }

    public function report()
    {
        $this->authorize('firearms.report');

        $accommodations = AccommodationDetails::where('firearm_id', '<>', null)->with('firearm', 'guest.identity', 'accommodation.room.hotel')->get();
        $hotels = Hotel::where('status', '<>', 'inactive')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view("pages.reports.firearms", ['accommodations' => $accommodations , 'x' => $x, 'hotels'=> $hotels]);
    }
}
