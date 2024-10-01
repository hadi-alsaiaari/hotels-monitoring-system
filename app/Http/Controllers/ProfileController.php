<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\HotelExecutiveManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\HotelUser;
use App\Models\HotelOwner;
use App\Models\HotelReceptionist;
use App\Models\Identity;
use App\Models\SecurityDepartmentOffice;
use App\Models\TourismOffice;
use App\Models\TouristPolice;
use App\Services\UploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function edit(Request $request): View
    {
        if (Config::get('fortify.guard') == 'security_department_office') {
            $user = $request->user();
            $identity = Identity::where('person_id', $user->id)->where('person_type', 'App\Models\SecurityDepartmentOffice')->first();
            return view('security_department_office.profile.profile', [
                'user' => $user,
                'identity' => $identity,
            ]);
        } elseif (Config::get('fortify.guard') == 'tourism_office') {
            $user = $request->user();
            $identity = Identity::where('person_id', $user->id)->where('person_type', 'App\Models\TourismOffice')->first();
            return view('tourism_office.profile.profile', [
                'user' => $user,
                'identity' => $identity,
            ]);
        } elseif (Config::get('fortify.guard') == 'tourist_police') {
            $user = $request->user();
            $identity = Identity::where('person_id', $user->id)->where('person_type', 'App\Models\TouristPolice')->first();
            return view('tourist_police.profile.profile', [
                'user' => $user,
                'identity' => $identity,
            ]);
        } elseif (Config::get('fortify.guard') == 'web') {
            $id = $request->user()->id;
            $user = HotelUser::findOrFail($id);
            if($user->user_of_hotel_type == 'App\Models\HotelOwner'){
                $hotel_user = $user->user_of_hotel()->with('phone_numbers', 'identity')->first();
                return view('hotels.pages.Profile', compact('hotel_user', 'user'));
            } elseif($user->user_of_hotel_type == 'App\Models\HotelExecutiveManager'){
                $hotel_user = $user->user_of_hotel()->with('identity')->first();
                return view('hotels.pages.Profile', compact('hotel_user', 'user'));
            }
            $hotel_user = $user->user_of_hotel()->with('identity')->first();
                return view('hotels.pages.Profile', compact('hotel_user', 'user'));
        }
    }

    public function edit_profile(Request $request)
    {
        $id = $request->user()->id;
        $hotel_user = HotelUser::find($id);

        $request->validate([
            'governorate' => [
                Rule::requiredIf(function () use ($hotel_user) {
                    return ($hotel_user->user_of_hotel_type == 'App\Models\HotelOwner');
                }),
                'string',
                'max:255'
            ],
            'city' => [
                Rule::requiredIf(function () use ($hotel_user) {
                    return ($hotel_user->user_of_hotel_type == 'App\Models\HotelOwner');
                }),
                'string',
                'max:255'
            ],
            'street_address' => [
                Rule::requiredIf(function () use ($hotel_user) {
                    return ($hotel_user->user_of_hotel_type == 'App\Models\HotelOwner');
                }),
                'string',
                'max:255'
            ],
            'phone_number.*' => [
                Rule::requiredIf(function () use ($hotel_user) {
                    return ($hotel_user->user_of_hotel_type == 'App\Models\HotelOwner');
                }),
                'string',
                'max:255'
            ],
        ]);
        $hotel_user = HotelUser::findOrFail($id);

        if ($hotel_user->user_of_hotel_type == 'App\Models\HotelOwner') {
            $user = HotelOwner::findOrFail($hotel_user->user_of_hotel_id);
            $personal_photo = UploadFile::updateUploadFile($request, 'personal_photo', $user->personal_photo, 'image');
            $user->update([
                'personal_photo' => $personal_photo,
                'governorate' => $request->governorate,
                'city' => $request->city,
                'street_address' => $request->street_address,
            ]);

            $phone_numbers = $request->phone_number;
            foreach ($phone_numbers as $phone_number) {
                // dd($phone_number);
                $user->phone_numbers()->update([
                    'phone_number' => $phone_number,
                ]);
            }


            $notification = array(
                'message' => 'Save Change successfully *_*',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Unsave Change successfully *_*',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function change_account_information(Request $request)
    {
        if (Config::get('fortify.guard') == 'security_department_office') {
            return view('security_department_office.profile.change_password', [
                'user' => $request->user(),
            ]);
        } elseif (Config::get('fortify.guard') == 'tourism_office') {
            $user = $request->user();
            $id = $request->user()->id;
            $TourismOffice = TourismOffice::find($id);
            return view('tourism_office.profile.change_password', compact('TourismOffice', 'user'));
        } elseif (Config::get('fortify.guard') == 'tourist_police') {
            return view('tourist_police.profile.change_password', [
                'user' => $request->user(),
            ]);
        } elseif (Config::get('fortify.guard') == 'web') {
            $id = $request->user()->id;
            $user = HotelUser::findOrFail($id);
            $hotel_owner = $user->user_of_hotel()->with('phone_numbers', 'identity')->first();
            return view('hotels.pages.change_account_information', compact('hotel_owner', 'user'));
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        if (Config::get('fortify.guard') == 'security_department_office') {
            return Redirect::route('profile_sdo.edit')->with('status', 'profile-updated');
        } elseif (Config::get('fortify.guard') == 'tourism_office') {
            return Redirect::route('profile_to.edit')->with('status', 'profile-updated');
        } elseif (Config::get('fortify.guard') == 'tourist_police') {
            return Redirect::route('profile_tp.edit')->with('status', 'profile-updated');
        } elseif (Config::get('fortify.guard') == 'web') {
            $notification = array(
                'message' => 'Save Change successfully',
                'alert-type' => 'success'
            );
            return Redirect::route('profile_h.edit')->with('status', 'profile-updated', $notification);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function addPhoneNumber(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'phone_number' => ['required', 'string', 'max:255'],
        ]);

        $hotel_user = $request->user();
        $hotel_owner = $hotel_user->user_of_hotel;
        $hotel_owner->phone_numbers()->create([
            'phone_number' => $request->phone_number,
        ]);

        $notification = array(
            'message' => 'Added phone number successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function destroyPhoneNumber($id)
    {
        $hotel_user = Auth::user();
        $hotel_owner = $hotel_user->user_of_hotel;
        $phone_numbers = $hotel_owner->phone_numbers;

        if (count($phone_numbers) > 1) {
            $phone_number = $hotel_owner->phone_numbers()->where('id', $id);

            $phone_number->delete();

            $notification = array(
                'message' => 'Deleted phone number successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Deleted phone number unsuccessfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
