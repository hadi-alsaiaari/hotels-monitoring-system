<?php

namespace App\Http\Controllers;

use App\Events\CreateNewUser;
use App\Models\HotelUser;
use App\Models\Identity;
use App\Models\MessagingAccount;
use App\Models\Role;
use App\Models\SecurityDepartmentOffice;
use App\Services\GeneratingPassword;
use App\Models\TourismOffice;
use App\Models\TouristPolice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Throwable;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('employees.view');

        $userss = Auth::user();
        $class_name = get_class($userss);
        if($class_name == 'App\Models\TourismOffice'){
            $user = TourismOffice::with('identity')->get();
        } elseif($class_name == 'App\Models\TouristPolice') {
            $user = TouristPolice::with('identity')->get();
        } elseif($class_name == 'App\Models\SecurityDepartmentOffice') {
            $user = SecurityDepartmentOffice::with('identity')->get();
        }
        $class_name = class_basename($userss);
        $x = Str::snake($class_name);
        
        return view('pages.employees.index', compact('user', 'x'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('employees.create');

        $userss = Auth::user();
        $class_name = get_class($userss);
        $roles = Role::where('institution_type', $class_name)->get();
        $class_name = class_basename($userss);
        $x = Str::snake($class_name);

        return view('pages.employees.create', ['x' => $x, 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('employees.create');

        $request->validate([
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

            'role_id' => 'required', 'exists:roles,id',
        ]);
        $check = Identity::checkEmployeeIdentity($request->date_of_birth, $request->date_of_issue, $request->date_of_expiry);
        if ($check != 1) {
            $notification = array(
                'message' => 'The date of date of birth, date of issue, or date of expiry are expired',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        DB::beginTransaction();
        try {
            $password = GeneratingPassword::generating_password();
            $userss = Auth::user();
            $class_name = get_class($userss);
            if($class_name == 'App\Models\TourismOffice'){
                $messaging_account_employee = MessagingAccount::where('name', 'Tourism Office')->first();
                $user = TourismOffice::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($password),
                    'role_id' => $request->role_id,
                    'messaging_account_id' => $messaging_account_employee->id,
                ]);
            } elseif($class_name == 'App\Models\TouristPolice') {
                $messaging_account_employee = MessagingAccount::where('name', 'Tourist Police')->first();
                $user = TouristPolice::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($password),
                    'role_id' => $request->role_id,
                    'messaging_account_id' => $messaging_account_employee->id,
                ]);
            } elseif($class_name == 'App\Models\SecurityDepartmentOffice') {
                $user = SecurityDepartmentOffice::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($password),
                    'role_id' => $request->role_id,
                ]);
            }
            $user->identity()->create([
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

            $full_name = $user->identity->full_name;
            event(new CreateNewUser($user, $full_name, $password, '/t-o/dashboard'));

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        $notification = array(
            'message' => 'Employee created successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('employees.update');

        $userss = Auth::user();
        $class_name = get_class($userss);
        if($class_name == 'App\Models\TourismOffice'){
            $user = TourismOffice::findOrFail($id)->with('identity')->first();
        } elseif($class_name == 'App\Models\TouristPolice') {
            $user = TouristPolice::findOrFail($id)->with('identity')->first();
        } elseif($class_name == 'App\Models\SecurityDepartmentOffice') {
            $user = SecurityDepartmentOffice::findOrFail($id)->with('identity')->first();
        }
        $roles = Role::where('institution_type', $class_name)->get();
        $user_role = $user->role->name;
        $class_name = class_basename($userss);
        $x = Str::snake($class_name);

        return view('pages.employees.edit', compact('user', 'roles', 'user_role', 'x'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('employees.update');

        $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
        ]);
        $userss = Auth::user();
        $class_name = get_class($userss);
        if($class_name == 'App\Models\TourismOffice'){
            $user = TourismOffice::findOrFail($id);
        } elseif($class_name == 'App\Models\TouristPolice') {
            $user = TouristPolice::findOrFail($id);
        } elseif($class_name == 'App\Models\SecurityDepartmentOffice') {
            $user = SecurityDepartmentOffice::findOrFail($id);
        }
        $user->update([
            'role_id' => $request->role_id,
        ]);

        $notification = array(
            'message' => 'Employee updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('employees.delete');

        $user = Auth::user();
        $class_name = get_class($user);
        if($class_name == 'App\Models\TourismOffice'){
            TourismOffice::findOrFail($id)->delete();
        } elseif($class_name == 'App\Models\TouristPolice') {
            TouristPolice::findOrFail($id)->delete();
        } elseif($class_name == 'App\Models\SecurityDepartmentOffice') {
            SecurityDepartmentOffice::findOrFail($id)->delete();
        }
    
        $notification = array(
            'message' => 'Employee deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function trash()
    {
        $this->authorize('employees.trash');

        $user = Auth::user();
        $class_name = get_class($user);
        if($class_name == 'App\Models\TourismOffice'){
            $users = TourismOffice::onlyTrashed()->with('identity', 'role')->get();
        } elseif($class_name == 'App\Models\TouristPolice') {
            $users = TouristPolice::onlyTrashed()->with('identity', 'role')->get();
        } elseif($class_name == 'App\Models\SecurityDepartmentOffice') {
            $users = SecurityDepartmentOffice::onlyTrashed()->with('identity', 'role')->get();
        }
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view('pages.users.trash', compact('users', 'role', 'x'));
    }

    public function restore($id)
    {
        $this->authorize('employees.restore');
        
        $user = Auth::user();
        $class_name = get_class($user);
        if($class_name == 'App\Models\TourismOffice'){
            $user = TourismOffice::onlyTrashed()->findOrFail($id)->restore();
        } elseif($class_name == 'App\Models\TouristPolice') {
            $user = TouristPolice::onlyTrashed()->findOrFail($id)->restore();
        } elseif($class_name == 'App\Models\SecurityDepartmentOffice') {
            $user = SecurityDepartmentOffice::onlyTrashed()->findOrFail($id)->restore();
        }

        $notification = array(
            'message' => 'Employee restored successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Route::get('/users/trash', [TourismOfficeController::class, 'trash'])
    //         ->name('tourism_offices.trash');
    // Route::put('users/{tourism_office}/restore', [TourismOfficeController::class, 'restore'])
    //         ->name('tourism_offices.restore');
}
