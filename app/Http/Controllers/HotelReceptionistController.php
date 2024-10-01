<?php

namespace App\Http\Controllers;

use App\Events\CreateNewUser;
use App\Models\Conversation;
use App\Models\HotelUser;
use App\Models\Identity;
use App\Models\MessagingAccount;
use App\Models\SecurityDepartmentOffice;
use App\Models\TourismOffice;
use App\Models\TouristPolice;
use App\Services\GeneratingPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Throwable;

class HotelReceptionistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $hotel_user = $user->user_of_hotel()->first();
        $hotel = $hotel_user->hotel()->first();
        $hotel_receptionists= $hotel->hotel_receptionists()->with('identity')->get();

        return view('hotels.hotel_receptionists.index', compact('hotel_receptionists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hotels.hotel_receptionists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'identity_number' => ['required', 'string', 'max:100'],
            'first_name'=> ['required', 'string', 'max:50'],
            'second_name'=> ['required', 'string', 'max:50'],
            'third_name'=> ['required', 'string', 'max:50'],
            'last_name'=> ['required', 'string', 'max:50'],
            'country'=> ['required', 'string', 'min:2', 'max:2'],
            'place_of_birth'=> ['required', 'string', 'max:255'],
            'date_of_birth'=> ['required', 'date'],
            'sex'=> ['required', 'string', 'in:male,female'],
            'date_of_issue'=> ['required', 'date'],
            'date_of_expiry'=> ['required', 'date'],
            'issuing_authority'=> ['required', 'string', 'max:100'],
            'identity_type'=> ['required', 'string', 'max:100'],

            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(TourismOffice::class),
                Rule::unique(TouristPolice::class),
                Rule::unique(SecurityDepartmentOffice::class),
                Rule::unique(HotelUser::class),
            ],
        ]);
        $check = Identity::checkEmployeeIdentity($request->date_of_birth, $request->date_of_issue, $request->date_of_expiry);
        if ($check != 1) {
            $notification = array(
                'message' => 'The date of date of birth, date of issue, or date of expiry are expired',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }

        $user = Auth::user();
        $hotel_executive_manager = $user->user_of_hotel()->first();

        DB::beginTransaction();
        try {
            $password = GeneratingPassword::generating_password();

            $messaging_account_name = $hotel_executive_manager->hotel->trade_name . " - Hotel Receptionist";
            $messaging_account = MessagingAccount::where('name', $messaging_account_name)->first();
            if($messaging_account){
                $hotel_receptionist = $hotel_executive_manager->hotel_receptionists()->create([
                    'hotel_id' => $hotel_executive_manager->hotel_id,
                    'messaging_account_id' => $messaging_account->id,
                ]);
            } else{
                $messaging_account = MessagingAccount::create([
                    'name' => $messaging_account_name,
                    'type' => 'hotel_receptionist',
                ]);
                
                $hotel_receptionist = $hotel_executive_manager->hotel_receptionists()->create([
                    'hotel_id' => $hotel_executive_manager->hotel_id,
                    'messaging_account_id' => $messaging_account->id,
                ]);
                
                $conversation = Conversation::where('label', 'All Hotel Receptionists')->first();
                $conversation->participants()->attach([
                    $messaging_account->id => ['joined_at' => now()],
                ]);

                $conversation_name = 'Tourist Police & ' . $messaging_account_name;
                $messaging_account_employee = MessagingAccount::where('name', 'Tourist Police')->first();
                $conversationexm = Conversation::create([
                    'messaging_account_id' => $messaging_account_employee->id,
                    'label' => $conversation_name,
                    'type' => 'peer',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $conversationexm->participants()->attach([
                    $messaging_account_employee->id => ['role' => 'admin', 'joined_at' => now()],
                    $messaging_account->id => ['role' => 'member', 'joined_at' => now()],
                ]);
            }

            $hotel_receptionist->identity()->create([
                'identity_number' => $request->identity_number,
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'third_name' => $request->third_name,
                'last_name' => $request->last_name,
                'country' => $request->country,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'sex' => $request->sex,
                'date_of_issue' => $request->date_of_issue,
                'date_of_expiry' => $request->date_of_expiry,
                'issuing_authority' => $request->issuing_authority,
                'identity_type' => $request->identity_type,
            ]);

            $hotel_user = $hotel_receptionist->hotel_user()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

            DB::commit();
            
            $full_name = $hotel_receptionist->identity->full_name;
            event(new CreateNewUser($hotel_user, $full_name, $password, '/hotel/dashboard'));

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        $notification = array(
            'message' => 'created new receptionist successfully',
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
        $hotel_user = $user->user_of_hotel()->first();
        $hotel = $hotel_user->hotel()->first();
        $hotel_receptionist= $hotel->hotel_receptionists()->findOrFail('id', $id)->with('identity')->first();
        dd($hotel_receptionist);
        return view('hotels.hotel_receptionists.show', compact('hotel_receptionist'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $hotel_user = $user->user_of_hotel()->first();
        $hotel = $hotel_user->hotel()->first();
        $hotel_receptionist= $hotel->hotel_receptionists()->findOrFail('id', $id)->with('identity')->first();
        dd($hotel_receptionist);
        if($hotel_receptionist){
            $hotel_receptionist->delete();
            $hotel_receptionist->hotel_user()->delete();
            $notification = array(
                'message' => 'Deleted receptionist successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Deleted receptionist unsuccessfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
