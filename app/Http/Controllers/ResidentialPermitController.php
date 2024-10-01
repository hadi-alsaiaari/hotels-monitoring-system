<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Hotel;
use App\Models\Identity;
use App\Models\ResidentialPermit;
use App\Models\TouristPolice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Throwable;

class ResidentialPermitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('residential-permit.view');

        $residential_permits = ResidentialPermit::with('hotel')->withCount(['permit_seekers'])->get();

        return view('tourist_police.residential_permit.index', compact('residential_permits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('residential-permit.create');

        $hotels = Hotel::where('status', '=', 'active')->get();

        return view('tourist_police.residential_permit.create', compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('residential-permit.create');
        // dd($request->all());
        $request->validate([
            'hotel_id' => ['required', 'exists:hotels,id'],
            'days_number' => ['required', 'int', 'max:5'],

            'permit_seekers.*.identity_number' => ['required', 'string', 'max:100'],
            'permit_seekers.*.first_name' => ['required', 'string', 'max:50'],
            'permit_seekers.*.second_name' => ['required', 'string', 'max:50'],
            'permit_seekers.*.third_name' => ['required', 'string', 'max:50'],
            'permit_seekers.*.last_name' => ['required', 'string', 'max:50'],
            'permit_seekers.*.country' => ['required', 'string', 'min:2', 'max:2'],
            'permit_seekers.*.place_of_birth' => ['nullable', 'string', 'max:255'],
            'permit_seekers.*.date_of_birth' => ['nullable', 'date'],
            'permit_seekers.*.sex' => ['required', 'string', 'in:male,female'],
            'permit_seekers.*.date_of_issue' => ['nullable', 'date'],
            'permit_seekers.*.date_of_expiry' => ['nullable', 'date'],
            'permit_seekers.*.issuing_authority' => ['nullable', 'string', 'max:100'],
            'permit_seekers.*.identity_type' => ['required', 'string', 'max:100'],

            'notice.*' => ['nullable', 'string'],
        ]);
        
        $manager = TouristPolice::where('super_tourist_police', true)->first();
        $tourist_police = request()->user();
        $manager_name = $manager->identity->full_name;
        $notices = $request->post('notice');

        DB::beginTransaction();
        try {
            $residential = $tourist_police->residential_permits()->create([
                'hotel_id' => $request->post('hotel_id'),
                'manager_name' => $manager_name,
                'days_number' => $request->post('days_number'),
            ]);

            foreach ($request->post('permit_seekers') as $number => $guest) {
                $check = Identity::checkGuestIdentity($guest['date_of_birth'], $guest['date_of_issue'], $guest['date_of_expiry']);
                if ($check != 1) {
                    $notification = array(
                        'message' => 'The date of date of birth, date of issue, or date of expiry are expired',
                        'alert-type' => 'info'
                    );
                    return redirect()->back()->with($notification);
                }
                $existguest = Guest::createOrGetGuest($guest);

                $residential->permit_seekers()->syncWithoutDetaching([
                    $existguest->id  => ['notice' => $notices[$number], 'created_at' => now(), 'updated_at' => now()],
                ]);
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        $notification = array(
            'message' => 'Add Residential permit successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('residential-permit.view');

        $residential_permit = ResidentialPermit::findOrFail($id)->with('hotel', 'permit_seekers.identity')->first();

        return view('tourist_police.residential_permit.show', [
            'residential_permit' => $residential_permit,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('residential-permit.update');

        $residential_permit = ResidentialPermit::findOrFail($id)->with('permit_seekers.identity')->first();

        // $residential_seekers = $residential_permit->permit_seekers;

        // $residential_guests = Guest::where('id', $residential_seekers->guest_id)->get();

        // $residential_with_guests = $residential_permit->with($residential_guests);

        return view('dashboard.residential_permit.edit', [
            'residential_with_guests' => $residential_permit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('residential-permit.update');
        
        $request->validate([
            'hotel_id' => ['required', 'exists:hotels,id'],
            'days_number' => ['required', 'int', 'max:5'],
        ]);

        $residential_permit = ResidentialPermit::findOrFail($id);
        if ($residential_permit->status != 'not_use') {
            $notification = array(
                'message' => 'Can not update the residential permit, because it has been used.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $tourist_police = request()->user();
        $residential_permit->update([
            'tourist_police_id' => $tourist_police->id,
            'hotel_id' => $request->hotel_id,
            'days_number' => $request->days_number,
        ]);

        $notification = array(
            'message' => 'Updated Residential permit successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
