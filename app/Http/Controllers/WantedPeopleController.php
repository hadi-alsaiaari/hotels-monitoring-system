<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Support\Str;
use App\Models\WantedPeople;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class WantedPeopleController extends Controller
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('wanted-people.view');

        $police = $this->request->user();
        $class_name = class_basename($police);
        $wanted_peoples = WantedPeople::where('policable_type', "App\Models\\$class_name")->withCount('accommodations_details')->get();
        $class_name = Str::snake($class_name);

        $user = Auth::user();
        $class_name1 = class_basename($user);
        $x = Str::snake($class_name1);
        return view("pages.wanted_people.index", compact('wanted_peoples','x'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('wanted-people.create');

        $police = $this->request->user();

        $user = Auth::user();
        $class_name1 = class_basename($user);
        $x = Str::snake($class_name1);
        return view("pages.wanted_people.create",compact('x'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $this->authorize('wanted-people.create');

        $this->request->validate([
            'wanted_people.identity_number' => ['required', 'string', 'max:100'],
            'wanted_people.first_name' => ['required', 'string', 'max:50'],
            'wanted_people.second_name' => ['required', 'string', 'max:50'],
            'wanted_people.third_name' => ['required', 'string', 'max:50'],
            'wanted_people.last_name' => ['required', 'string', 'max:50'],
        ]);
        $police = $this->request->user();
        $class_name = get_class($police);
        $wanted_people = WantedPeople::where('identity_number', $this->request->wanted_people['identity_number'])->where("sure_at", null)->where("policable_type", $class_name)->first();
        if (empty($wanted_people)) {
            $wanted_people = $police->wanted_peoples()->create($this->request->wanted_people);
            $notification = array(
                'message' => 'Added Wanted People successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => 'The wanted people is already exit!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($wanted_people_id)
    {
        $this->authorize('wanted-people.view');
        
        $police = $this->request->user();
        $class_name = class_basename($police);
        $wanted_people = WantedPeople::where('policable_type', "App\Models\\$class_name")->where('id', $wanted_people_id)->first();
        $potential_peoples_unclear = $wanted_people->accommodations_details()->with('accommodation.room.hotel', 'guest.identity')->get();
        $potential_peoples = [];
        foreach ($potential_peoples_unclear as $number => $potential_people) {
            $potential_peoples[$number]['id'] = $potential_people->id;
            $potential_peoples[$number]['full_name'] = $potential_people->guest->identity->full_name;
            $potential_peoples[$number]['hotel_name'] = $potential_people->accommodation->room->hotel->trade_name;
            $potential_peoples[$number]['room_number'] = $potential_people->accommodation->room->number;
            $potential_peoples[$number]['accommodation_number'] = $potential_people->accommodation->number_accommodation;
            $potential_peoples[$number]['detection_at'] = $potential_people->pivot->detection_at;
            $potential_peoples[$number]['is_same'] = $potential_people->pivot->is_same;
        }
        $class_name = Str::snake($class_name);
        $user = Auth::user();
        $class_name1 = class_basename($user);
        $x = Str::snake($class_name1);
        if ($wanted_people) {
            return view("pages.wanted_people.show", [
                'wanted_people' => $wanted_people,
                'potential_peoples' => $potential_peoples,
                'x' =>$x,
            ]);
        }
        $notification = array(
            'message' => 'The wanted people is not exit.',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }


    // public function edit($id)
    // {
    //     $police = $this->request->user();
    //     $class_name = get_class($police);
    //     $wanted_people = WantedPeople::where('policable_type', $class_name)->where('id', $id)->with('identity')->first();

    //     $class_name = class_basename($police);
    //     $class_name = Str::snake($class_name);

    //     if ($wanted_people) {
    //         return view("$class_name.wanted_people.edit", compact('wanted_people'));
    //     }

    //     $notification = array(
    //         'message' => 'The wanted people is not exit.',
    //         'alert-type' => 'info'
    //     );
    //     return redirect()->back()->with($notification);
    // }
    // public function update($id)
    // {
    //     $this->request->validate([
    //         'wanted_people.first_name' => ['required', 'string', 'max:255'],
    //     ]);

    //     $police = $this->request->user();
    //     $class_name = get_class($police);
    //     $wanted_people = WantedPeople::where('policable_type', $class_name)->where('id', $id)->with('identity')->first();

    //     if ($wanted_people) {
    //         $wanted_people()->identity()->update($this->request->post('wanted_people'));
    //         $notification = array(
    //             'message' => 'Update wanted people information successfully.',
    //             'alert-type' => 'success'
    //         );
    //         return redirect()->back()->with($notification);
    //     }

    //     $notification = array(
    //         'message' => 'The wanted people is not exit.',
    //         'alert-type' => 'info'
    //     );
    //     return redirect()->back()->with($notification);
    // }


    /**
     * Remove the specified resource into trash.
     */
    public function destroy()
    {
        $this->authorize('wanted-people.delete');

        $police = $this->request->user();
        $class_name = get_class($police);
        $wanted_people = WantedPeople::where('policable_type', $class_name)->where('id', $this->request->wanted_people_id)->where('sure_at', null)->first();
        if ($wanted_people) {
            DB::beginTransaction();
            try {
                $wanted_people->policable_id = $police->id;
                $wanted_people->save();
                $wanted_people->delete();

                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                throw $e;
            }
            
            $notification = array(
                'message' => 'Deleted the wanted people successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'The wanted people is not exit.',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display a listing of only the deleted  resource.
     */
    public function trash()
    {
        if (!(Gate::allows('wanted-people.restore')) && !(Gate::allows('wanted-people.force-delete'))) {
            return abort(403);
        }

        $police = $this->request->user();
        $class_name = class_basename($police);
        $wanted_peoples = WantedPeople::onlyTrashed()->where('policable_type', "App\Models\\$class_name")->withCount('accommodations_details')->get();
        $class_name = Str::snake($class_name);

        $user = Auth::user();
        $class_name1 = class_basename($user);
        $x = Str::snake($class_name1);

        return view("pages.wanted_people.trash", compact('wanted_peoples','x'));
    }

    /**
     * Restore the deleted resource from trash.
     */
    public function restore()
    {
        $this->authorize('wanted-people.restore');

        $police = $this->request->user();
        $class_name = get_class($police);
        $wanted_people = WantedPeople::onlyTrashed()->where('policable_type', $class_name)->where('id', $this->request->wanted_people_id)->first();
        if ($wanted_people) {
            $wanted_people->restore();
            $notification = array(
                'message' => 'Restore the wanted people successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'The wanted people is not exit.',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Force delete of resource from storage.
     */
    public function forceDelete()
    {
        $this->authorize('wanted-people.force-delete');

        $police = $this->request->user();
        $class_name = get_class($police);
        $wanted_people = WantedPeople::onlyTrashed()->where('policable_type', $class_name)->where('id', $this->request->wanted_people_id)->where('sure_at', null)->first();
        if ($wanted_people) {
            $wanted_people->forceDelete();
            $notification = array(
                'message' => 'Force Deleted the wanted people successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'The wanted people is not exit.',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Delete the specified potential people from storage.
     */
    public function deletePotentialPeople()
    {
        $this->authorize('wanted-people.delete-potential-people');

        $police = $this->request->user();
        $class_name = get_class($police);
        
        $wanted_people = WantedPeople::where('policable_type', $class_name)->where('id', $this->request->wanted_people_id)->where('sure_at', null)->first();
        if (!empty($wanted_people)) {
            $dele = $wanted_people->accommodations_details()->detach($this->request->accommodation_details_id);
            if ($dele == 1) {
                $notification = array(
                    'message' => 'Deleted potential people successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }
            
            $notification = array(
                'message' => 'The potential people is not exit.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'The wanted people is not exit.',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Sure the specified potential people and delete all others for resource from storage.
     */
    public function sureDetection()
    {
        $this->authorize('wanted-people.sure-detection');

        $police = $this->request->user();
        $class_name = get_class($police);
        
        $wanted_people = WantedPeople::where('policable_type', $class_name)->where('id', $this->request->wanted_people_id)->where('sure_at', null)->first();
        if (!empty($wanted_people)) {
            DB::beginTransaction();
            try {
                $upda = $wanted_people->accommodations_details()->where('accommodation_details_id', $this->request->accommodation_details_id)->update([
                    'is_same'=>1,
                ]);
                $wanted_people->is_detection = 1;
                $wanted_people->sure_at = now();
                $wanted_people->save();
                $wanted_people->accommodations_details_not_same()->detach();

                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                throw $e;
            }
            
            if ($upda == 2) {
                $notification = array(
                    'message' => 'The potential people matched with the wanted people successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }
            $notification = array(
                'message' => 'The potential people is not exit.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => 'The wanted people is not exit.',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function report()
    {
        $this->authorize('wanted-people.report');

        $request = request();
        $user = Auth::user();
        $class_name = class_basename($user);
        $wanted_peoples = WantedPeople::where('policable_type', "App\Models\\$class_name")->filter($request->all())->get();
        $x = Str::snake($class_name);

        return view("pages.reports.wanted_people", ['wanted_peoples' => $wanted_peoples , 'x' => $x]);
    }
}
