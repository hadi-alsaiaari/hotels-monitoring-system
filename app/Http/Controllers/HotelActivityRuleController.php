<?php

namespace App\Http\Controllers;

use App\Models\AccommodationDetails;
use App\Models\Hotel;
use App\Models\HotelActivityRule;
use App\Models\Tax;
use App\Services\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class HotelActivityRuleController extends Controller
{
    public function index_hotel()
    {
        // $filters = ['start_at' =>'wedf', 'end_at' =>'wedf', 'hotel_id' =>'wedf', 'is_foreigner' =>'wedf', 'country' =>'wedf', 'is_firearm' =>'wedf', 'is_residential_permit' =>'wedf', ];
        // $guests = AccommodationDetails::with('guest.identity', 'firearm', 'accommodation.room.hotel:id,trade_name', 'accommodation.hotel_receptionist.identity')->filter()->get();
        // $hotels = Hotel::where('status', '=', 'active')->with('hotel_owner.identity')->withCount('rooms')->get();
        // dd($hotels->where('id', 1));
        // $taxes = Tax::whereMonth('created_at', now()->month())->orderBy('hotel_id')->get();
        // $month = now()->subMonth();
        // $end_month = $month->endOfMonth();
        // $start_month = $month->startOfMonth();
        // $date_of_issue = '1999-06-18';
        // $date_of_expiry = '1990-05-18';
        // $date_of_issue = now()->setDateFrom($date_of_issue)->addRealYear();
        // dd($date_of_issue > $date_of_expiry);
















        
        $rules = HotelActivityRule::get();
        return view('hotels.pages.hotel_activity_rules', compact('rules'));
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rules = HotelActivityRule::get();
        return view('tourism_office.hotel_activity_rules.index', compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('hotel-activity-rules.create');
        return view('tourism_office.hotel_activity_rules.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('hotel-activity-rules.create');

        $request->validate([
            'body' => ['required'],
            'image' => ['required', 'mimes:pdf', 'max:5150'],
        ]);
        $image = UploadFile::newUploadFile($request, 'image');
        HotelActivityRule::create([
            'body' => $request->body,
            'image' => $image,
        ]);

        $notification = array(
            'message' => 'Added rule successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('hotel-activity-rules.view');

        $rule= HotelActivityRule::findOrFail($id);

        return view('dashboard.hotel_activity_rule.show', compact('rule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('hotel-activity-rules.update');

        $rule= HotelActivityRule::findOrFail($id);

        return view('tourism_office.hotel_activity_rules.create_edit', compact('rule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('hotel-activity-rules.update');
        
        $request->validate([
            'body' => ['required'],
            'image' => ['nullable', 'mimes:pdf', 'max:5150'],
        ]);
        $data = $request->except('image');
        $hotel_activity_rule= HotelActivityRule::findOrFail($id);
        $old_image = $hotel_activity_rule->image;
        $new_image = UploadFile::newUploadFile($request, 'image');
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $hotel_activity_rule->update($data);
        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        $notification = array(
            'message' => 'Updated rule successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('hotel-activity-rules.delete');

        $hotel_activity_rule= HotelActivityRule::findOrFail($id);
        $hotel_activity_rule->delete();

        $notification = array(
            'message' => 'Deleted rule successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
