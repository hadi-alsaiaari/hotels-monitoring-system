<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelUser;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    public function index()
    {
        $users = HotelUser::whereExists(function (Builder $builder) {
            $x = 'App\Models\HotelExecutiveManager';
            $builder->from('hotel_executive_managers')
                ->whereRaw('hotel_users.user_of_hotel_id = hotel_executive_managers.id AND user_of_hotel_type = ?', [$x])
                ->whereExists(function ($query) {
                    $query->from('hotels')
                        ->whereRaw("hotel_executive_managers.hotel_id = hotels.id AND hotels.status <> ?", ['inactive']);
                });
        })->get();
        //dd($users);
        $this->authorize('hotels.view');

        $hotels = Hotel::where('status', '=', 'active')->with('hotel_owner.identity', 'phone_numbers', 'documents')->withCount('rooms')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view('pages.hotels.index', ['hotels' => $hotels, 'x' => $x]);
    }

    public function show($id)
    {
        $this->authorize('hotels.view');

        $hotel = Hotel::findOrFail($id)->where('status', '=', 'active')->with('hotel_owner.identity', 'rooms', 'phone_numbers', 'documents')->first();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);
        return view('pages.hotels.show', ['hotel' => $hotel, 'x' => $x]);
    }

    public function report()
    {
        // $this->authorize('hotels.view');
        // $x = now()->startOfMonth();
        // dd($x);
        $hotels = Hotel::where('status', '=', 'active')->with('hotel_owner.identity')->withCount('rooms', '', '')->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);
        return view('pages.hotels.index', ['hotels' => $hotels, 'x' => $x]);
    }

    // On Hotel Users
    public function hotel_details()
    {
        $user = Auth::user();
        $hotel_owner = $user->user_of_hotel;
        $hotel = Hotel::findOrFail($hotel_owner->hotel_id)->load('hotel_executive_managers.identity', 'hotel_receptionists.identity', 'phone_numbers', 'documents', 'rooms');

        return view('hotels.pages.hotel_details', compact('hotel'));
    }
}
