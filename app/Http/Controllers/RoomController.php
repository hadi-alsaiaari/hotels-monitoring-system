<?php

namespace App\Http\Controllers;

use App\Events\CreateNewRoom;
use App\Events\UpdateRoom;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $hotel_id = $user->user_of_hotel->hotel_id;
        $rooms = Room::where('hotel_id', $hotel_id)->get();

        return view('hotels.rooms.index', [
            'rooms' => $rooms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hotels.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'number' => ['required', 'numeric'],
            'category' => ['required', 'string', 'in:A,B,C,D,E'],
            'type' => ['required', 'string', 'in:Single,Double,Treble,Apartment,Suite'],
            'floor' => ['required', 'numeric', 'max:255'],
            'price' => ['required', 'numeric'],
        ]);
        
        $user = Auth::user();
        $hotel_id = $user->user_of_hotel->hotel_id;
        $hotel = Hotel::findOrFail($hotel_id);

        $hotel->rooms()->create([
            'number' => $request->number,
            'category' => $request->category,
            'type' => $request->type,
            'floor' => $request->floor,
            'price' => $request->price,
        ]);

        $notification = array(
            'message' => 'Add room successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $hotel_id = $user->user_of_hotel->hotel_id;
        $hotel = Hotel::findOrFail($hotel_id);

        $room = $hotel->rooms()->where('id', $id)->first();

        return view('hotels.rooms.show', [
            'room' => $room,
        ]);
    }

    

    


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $hotel_id = $user->user_of_hotel->hotel_id;
        $hotel = Hotel::findOrFail($hotel_id);

        $room = $hotel->rooms()->where('id', $id)->first();

        $room->delete();

        $hotel_name = $hotel->trade_name;
        event(new UpdateRoom($room, $hotel_name));

        $notification = array(
            'message' => 'Delete room successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


/**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $request = request();
        $hotel_id = $request->hotel_id;
        $hotel = Hotel::findOrFail($hotel_id);

        $room = $hotel->rooms()->where('id', $id)->first();

        return view('hotels.rooms.edit', [
            'room' => $room,
        ]);
    }

    public function storeNew(Request $request)
    {
        $request->validate([
            'number' => ['required', 'numeric'],
            'category' => ['required', 'string', 'in:A,B'],
            'type' => ['required', 'string', 'in:Single,Double,Treble,Apartment,Suite'],
            'floor' => ['required', 'numeric', 'max:255'],
            'price' => ['required', 'numeric'],
        ]);

        $user = Auth::user();
        $hotel_id = $user->user_of_hotel->hotel_id;
        $hotel = Hotel::findOrFail($hotel_id);

        $room = $hotel->rooms()->create([
            'number' => $request->number,
            'category' => $request->category,
            'type' => $request->type,
            'floor' => $request->floor,
            'price' => $request->price,
        ]);
        $hotel_name = $hotel->trade_name;

        event(new CreateNewRoom($room, $hotel_name));

        $notification = array(
            'message' => 'Add room successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'number' => ['required', 'numeric'],
            'category' => ['required', 'string', 'in:A,B,C,D,E'],
            'type' => ['required', 'string', 'in:Single,Double,Treble,Apartment,Suite'],
            'floor' => ['required', 'numeric', 'max:255'],
            'price' => ['required', 'numeric'],
        ]);

        $user = Auth::user();
        $hotel_id = $user->user_of_hotel->hotel_id;
        $hotel = Hotel::findOrFail($hotel_id);
        $room = $hotel->rooms()->where('id', $id)->first();

        $room->update([
            'number' => $request->number,
            'category' => $request->category,
            'type' => $request->type,
            'floor' => $request->floor,
            'price' => $request->price,
        ]);
        $hotel_name = $hotel->trade_name;
        event(new UpdateRoom($room, $hotel_name));

        $notification = array(
            'message' => 'update room successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
