<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('roles.view');

        $user = Auth::user();
        $class_name = get_class($user);
        $roles = Role::where('institution_type', $class_name)->get();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view('pages.roles.index', compact('roles','x'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('roles.create');
        
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);

        return view('pages.roles.edit', ['role' => new Role(), 'x' =>$x]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('roles.create');

        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
        ]);
        $user = Auth::user();
        Role::createWithAbilities($request,$user);

        $notification = array(
            'message' => 'Role Created unsuccessfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('roles.update');

        $user = Auth::user();
        $class_name = get_class($user);
        $role = Role::whereRaw("id = ? AND institution_type = ?",[$id, $class_name])->first();
        $user = Auth::user();
        $class_name = class_basename($user);
        $x = Str::snake($class_name);
        if($role){
            $role_abilities = $role->abilities()->pluck('type', 'ability')->toArray();
            return view('pages.roles.edit', compact('role', 'role_abilities','x'));
        }

        $notification = array(
            'message' => 'Role is not exit!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('roles.update');

        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
        ]);
        $user = Auth::user();
        $class_name = get_class($user);
        $role = Role::whereRaw("id = ? AND institution_type = ?",[$id, $class_name])->first();
        if($role){
            $role->updateWithAbilities($request);
            $notification = array(
                'message' => 'Role updated successfully!',
                'alert-type' => 'success'
            );
            $user = Auth::user();
            $class_name = class_basename($user);
            $x = Str::snake($class_name);
            return redirect()->route("{$x}_roles_all.index")->with($notification);
        }

        $notification = array(
            'message' => 'Role is not exit!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('roles.delete');

        $user = Auth::user();
        $class_name = get_class($user);
        $role = Role::whereRaw("id = ? AND institution_type = ?",[$id, $class_name])->first();
        if($role){
            $role->delete();
            $notification = array(
                'message' => 'Role deleted successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Role deleted unsuccessfully!',
            'alert-type' => 'info'
        );
        return Redirect()->back()->with($notification);
    }
}
