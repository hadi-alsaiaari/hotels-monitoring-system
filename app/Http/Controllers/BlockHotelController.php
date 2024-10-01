<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelActivityRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class BlockHotelController extends Controller
{
    public function index()
    {
        // $this->authorize('hotel-block');

        $hotels_block = Hotel::where('status', '=', 'block')->with('hotel_owner.identity', 'phone_numbers')->withCount('rooms')->get();
        $hotels = Hotel::where('status', '=', 'active')->with('hotel_owner.identity', 'phone_numbers')->withCount('rooms')->get();
        $hotel_activity_rules = HotelActivityRule::get();
        
        return view('tourism_office.hotel_blocked.index', [
            'hotels_block' => $hotels_block,
            'hotel_activity_rules'=> $hotel_activity_rules,
            'hotels' => $hotels
        ]);
    }

    public function show($id)
    {
        // $this->authorize('hotel-block');

        $hotel = Hotel::findOrFail($id)->where('status', '=', 'block')->with('hotel_owner.identity', 'rooms', 'phone_numbers', 'documents')->first();

        return view('tourism_office.hotel_block.show', ['hotel' => $hotel]);
    }

    public function on_block(Request $request)
    {
        // $this->authorize('hotel-block');
        
        $hotel = Hotel::where('status', '=', 'active')->where('id', '=', $request->id)->first();
        $hotel_activity_rule = HotelActivityRule::findOrFail($request->hotel_activity_rule_id);
        DB::beginTransaction();
        try {
            $hotel->update([
                'status' => 'block',
            ]);

            $hotel->block_hotel()->create([
                'hotel_activity_rule_id' => $hotel_activity_rule->id,
                'body' => $request->body,
            ]);
        
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        $notification = array(
            'message' => 'Blocked hotel successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function up_block($id)
    {
        // $this->authorize('hotel-block');

        $hotel = Hotel::where('id', '=', $id)->first();
        DB::beginTransaction();
        try {
            $hotel->update([
                'status' => 'active',
            ]);

            $hotel->block_hotel()->update([
                'unblock_at' => now(),
            ]);
        
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        $notification = array(
            'message' => 'Unblocked hotel successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
