<?php

namespace App\Http\Controllers;

use App\Events\CreateNewUser;
use App\Models\Conversation;
use App\Models\HotelExecutiveManager;
use App\Models\HotelUser;
use App\Models\Identity;
use App\Models\MessagingAccount;
use App\Models\SecurityDepartmentOffice;
use App\Models\TourismOffice;
use App\Models\TouristPolice;
use App\Services\GeneratingPassword;
use App\Services\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Throwable;

class HotelExecutiveManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $hotel_owner = $user->user_of_hotel()->first();
        $hotel = $hotel_owner->hotels()->where('id', $hotel_owner->hotel_id)->first();
        $hotel_executive_manager = $hotel->hotel_executive_manager;

        return view('hotels.Executive_manager.index', compact('hotel_executive_manager'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hotels.Executive_manager.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'identity_number' => ['required', 'string', 'max:100'],
            'first_name' => ['required', 'string', 'max:50'],
            'second_name' => ['required', 'string', 'max:50'],
            'third_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'country' => ['required', 'string', 'min:2', 'max:2'],
            'place_of_birth' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'sex' => ['required', 'string', 'in:male,female'],
            'date_of_issue' => ['required', 'date'],
            'date_of_expiry' => ['required', 'date'],
            'issuing_authority' => ['required', 'string', 'max:100'],
            'identity_type' => ['required', 'string', 'max:100'],

            'education_level' => ['required', 'string', 'max:255'],
            'date_of_work_license' => ['required', 'date'],
            'work_license_number' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'mimes:pdf', 'max:5150'],
            'experience_certificate' => ['required', 'mimes:pdf', 'max:5150'],
            'identity_photo' => ['required', 'image', 'max:5150'],

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
        $hotel_owner = $user->user_of_hotel;
        DB::beginTransaction();
        try {
            $password = GeneratingPassword::generating_password();

            $qualification = UploadFile::newUploadFile($request, 'qualification');
            $experience_certificate = UploadFile::newUploadFile($request, 'experience_certificate');
            $identity_photo = UploadFile::newUploadFile($request, 'identity_photo', 'image');

            $hotel = $hotel_owner->hotel();
            $hotel_executive_manager = $hotel->hotel_executive_manager;
            if ($hotel_executive_manager) {
                $hotel_executive_manager->delete();
                $hotel_executive_manager->hotel_user()->delete();
            }
            
            $messaging_account_name = $hotel->trade_name . " - Hotel Executive Manager";
            $messaging_account = MessagingAccount::where('name', $messaging_account_name)->first();
            if ($messaging_account) {
                $hotel_executive_manager = HotelExecutiveManager::create([
                    'hotel_id' => $hotel->id,
                    'education_level' => $request->education_level,
                    'date_of_work_license' => $request->date_of_work_license,
                    'work_license_number' => $request->work_license_number,
                    'qualification' => $qualification,
                    'experience_certificate' => $experience_certificate,
                    'identity_photo' => $identity_photo,
                    'messaging_account_id' => $messaging_account->id,
                ]);
            } else {
                $messaging_account = MessagingAccount::create([
                    'name' => $messaging_account_name,
                    'type' => 'hotel_executive_manager',
                ]);

                $hotel_executive_manager = HotelExecutiveManager::create([
                    'hotel_id' => $hotel->id,
                    'education_level' => $request->education_level,
                    'date_of_work_license' => $request->date_of_work_license,
                    'work_license_number' => $request->work_license_number,
                    'qualification' => $qualification,
                    'experience_certificate' => $experience_certificate,
                    'identity_photo' => $identity_photo,
                    'messaging_account_id' => $messaging_account->id,
                ]);

                $conversation = Conversation::where('label', 'All Hotel Executive Manageres')->first();
                $conversation->participants()->attach([
                    $messaging_account->id => ['joined_at' => now()],
                ]);

                $conversation_name = 'Tourism Office & ' . $messaging_account_name;
                $messaging_account_employee = MessagingAccount::where('name', 'Tourism Office')->first();
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

            $hotel_user = $hotel_executive_manager->hotel_user()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

            $hotel_executive_manager->identity()->create([
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

            DB::commit();

            $full_name = $hotel_executive_manager->identity->full_name;
            event(new CreateNewUser($hotel_user, $full_name, $password, '/hotel/dashboard'));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        $notification = array(
            'message' => 'created successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function trash()
    {
        $user = Auth::user();
        $hotel_owner = $user->user_of_hotel;
        $hotel = $hotel_owner->hotel();
        $hotel_executive_managers = HotelExecutiveManager::onlyTrashed()->where('hotel_id', $hotel->id)->with('identity')->get();
        
        return view('hotels.Executive_manager.trash', compact('hotel_executive_managers'));
    }

    public function restore($id)
    {
        $user = Auth::user();
        $hotel_owner = $user->user_of_hotel;
        $hotel = $hotel_owner->hotel();
        DB::beginTransaction();
        try {
            $hotel_executive_manager = $hotel->hotel_executive_manager;
            if ($hotel_executive_manager) {
                $hotel_executive_manager->delete();
                $hotel_executive_manager->hotel_user()->delete();
            }
            HotelExecutiveManager::onlyTrashed()->where('hotel_id', $hotel->id)->where('id', $id)->first()->restore();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        $notification = array(
            'message' => 'Restored executive manager successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Route::get('/executive_managers/trash', [TourismOfficeController::class, 'trash'])
    //         ->name('hotel_executive_managers.trash');
    // Route::put('/executive_managers/{hotel_executive_manager}/restore', [TourismOfficeController::class, 'restore'])
    //         ->name('hotel_executive_managers.restore');
}
