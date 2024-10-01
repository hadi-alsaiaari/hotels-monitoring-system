<?php

namespace App\Http\Controllers;

use App\Events\ChangeTaxPercentage;
use App\Models\TaxPercentage;
use App\Models\TouristPolice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class TaxPercentageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('tax-percentage.view');

        $tax_percentage_useds = TaxPercentage::where('status', 'used')->get();

        $tax_percentage_comings = TaxPercentage::where('status', 'coming')->get();

        return view('tourism_office.tax.percentage.index', [
            'tax_percentage_useds' => $tax_percentage_useds,
            'tax_percentage_comings' => $tax_percentage_comings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($class)
    {
        $this->authorize('tax-percentage.create');

        $tax_percentage_coming = TaxPercentage::where('class', $class)->where('status', 'coming')->first();

        return view('tourism_office.tax.percentage.create', [
            'class' => $class,
            'tax_percentage_coming' => $tax_percentage_coming,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request, $class)
    // {
    //     $this->authorize('tax-percentage.create');

    //     $request = $request->merge([
    //         'class' => $class,
    //     ]);
    //     $request->validate([
    //         'class' => ['required', 'string', 'in:one,two,three,four,five'],
    //         'percentage' => ['required', 'numeric', 'max:100',],
    //         'decision' => ['required', 'mimes:pdf', 'max:5150'],
    //         'implementation_date' => ['required', 'date'],
    //     ]);
    //     // $implementation_date = now()->setDateFrom($request->implementation_date);
    //     $implementation_date = Carbon::createFromFormat('Y-m-d', $request->implementation_date);

    //     if (($implementation_date->day == '01') && ($implementation_date > Carbon::now())) {

    //         $tax_percentage_coming = TaxPercentage::where('class', $request->class)->where('status', 'coming')->first();
    //         $tax_percentage_used = TaxPercentage::where('class', $request->class)->where('status', 'used')->first();

    //         if ($tax_percentage_coming) {
    //             DB::beginTransaction();
    //             try {
    //                 $tax_percentage_coming->forceDelete();
    //                 if ($tax_percentage_coming->decision) {
    //                     Storage::disk('public')->delete($tax_percentage_coming['decision']);
    //                 }

    //                 TaxPercentage::createComingPercentage($request);

    //                 if ($tax_percentage_used) {
    //                     TaxPercentage::updateUsedPercentage($tax_percentage_used,$implementation_date);
    //                 }

    //                 DB::commit();
    //             } catch (Throwable $e) {
    //                 DB::rollBack();
    //                 throw $e;
    //             }
    //             $notification = array(
    //                 'message' => "Deleted tax percentage which would have been used, and added new tax percentage, will start using from $request->implementation_date .",
    //                 'alert-type' => 'info'
    //             );
    //             return redirect()->back()->with($notification);
    //         }

    //         TaxPercentage::createComingPercentage($request);

    //         if ($tax_percentage_used) {
    //             TaxPercentage::updateUsedPercentage($tax_percentage_used, $implementation_date);
    //         }

    //         $notification = array(
    //             'message' => "added new tax percentage, and will start using from $request->implementation_date .",
    //             'alert-type' => 'info'
    //         );
    //         return redirect()->back()->with($notification);
    //     }

    //     $notification = array(
    //         'message' => 'This date is invalid.',
    //         'alert-type' => 'info'
    //     );
    //     return redirect()->back()->with($notification);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('tax-percentage.delete');
        $tax_percentage = TaxPercentage::findOrFail($id);
        $tax_percentage->delete();
    }

    public function trash()
    {
        $tax_percentages = TaxPercentage::onlyTrashed()->paginate();
        return view('tourism_office.tax_percentages.trash', compact('tax_percentages'));
    }

    public function forceDelete($id)
    {
        $tax_percentage_coming = TaxPercentage::findOrFail($id);

        if ($tax_percentage_coming->status == 'coming') {
            DB::beginTransaction();
            try {
                $tax_percentage_used = TaxPercentage::where('class', $tax_percentage_coming->class)->where('status', 'used')->first();
                $tax_percentage_used->expiry_date = null;
                $tax_percentage_coming->forceDelete();
                if ($tax_percentage_coming->decision) {
                    Storage::disk('public')->delete($tax_percentage_coming['decision']);
                }

                DB::commit();
            } catch (Throwable $e) {
                DB::rollBack();
                throw $e;
            }
            $notification = array(
                'message' => 'tax percentage deleted successfully!',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message' => 'tax percentage deleted unsuccessfully!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }








    public function store(Request $request, $class)
    {
        $this->authorize('tax-percentage.create');

        $request = $request->merge([
            'class' => $class,
        ]);
        $request->validate([
            'class' => ['required', 'string', 'in:one,two,three,four,five'],
            'percentage' => ['required', 'numeric', 'max:100',],
            'decision' => ['required', 'mimes:pdf', 'max:5150'],
            'implementation_date' => ['required', 'date'],
        ]);
        // $implementation_date = now()->setDateFrom($request->implementation_date);
        $implementation_date = Carbon::createFromFormat('Y-m-d', $request->implementation_date);

        if (($implementation_date->day == '01') && ($implementation_date > Carbon::now())) {

            $tax_percentage_coming = TaxPercentage::where('class', $request->class)->where('status', 'coming')->first();
            $tax_percentage_used = TaxPercentage::where('class', $request->class)->where('status', 'used')->first();
            $percentages_coming = TaxPercentage::where('status', 'coming')->get();
            $percentages_used = TaxPercentage::where('status', 'used')->get();

            if ($request->class == 'one') {
                if (!empty($percentages_coming->where('class', 'two')->first())) {
                    $retValue = ($request->percentage <= $percentages_coming->where('class', 'two')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_coming->where('class', 'three')->first())) {
                    $retValue = ($request->percentage <= $percentages_coming->where('class', 'three')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_coming->where('class', 'four')->first())) {
                    $retValue = ($request->percentage <= $percentages_coming->where('class', 'four')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_coming->where('class', 'five')->first())) {
                    $retValue = ($request->percentage <= $percentages_coming->where('class', 'five')->first()->percentage) ? 1 : 2;
                }
            } elseif ($request->class == 'two') {
                if (!empty($percentages_coming->where('class', 'three')->first())) {
                    if (!empty($percentages_coming->where('class', 'one')->first())) {

                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'three')->first()->percentage && $request->percentage >= $percentages_coming->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'three')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_coming->where('class', 'four')->first())) {
                    if (!empty($percentages_coming->where('class', 'one')->first())) {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'four')->first()->percentage && $request->percentage >= $percentages_coming->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'four')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_coming->where('class', 'five')->first())) {
                    if (!empty($percentages_coming->where('class', 'one')->first())) {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_coming->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'five')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_coming->where('class', 'one')->first())) {
                    $retValue = ($request->percentage >= $percentages_coming->where('class', 'one')->first()->percentage) ? 1 : 2;
                }
            } elseif ($request->class == 'three') {
                if (!empty($percentages_coming->where('class', 'four')->first())) {
                    if (!empty($percentages_coming->where('class', 'two')->first())) {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'four')->first()->percentage && $request->percentage >= $percentages_coming->where('class', 'two')->first()->percentage) ? 1 : 2;
                    } elseif (!empty($percentages_coming->where('class', 'one')->first())) {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'four')->first()->percentage && $request->percentage >= $percentages_coming->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'four')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_coming->where('class', 'five')->first())) {
                    if (!empty($percentages_coming->where('class', 'two')->first())) {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_coming->where('class', 'two')->first()->percentage) ? 1 : 2;
                    } elseif (!empty($percentages_coming->where('class', 'one')->first())) {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_coming->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'five')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_coming->where('class', 'two')->first())) {
                    $retValue = ($request->percentage >= $percentages_coming->where('class', 'two')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_coming->where('class', 'one')->first())) {
                    $retValue = ($request->percentage >= $percentages_coming->where('class', 'one')->first()->percentage) ? 1 : 2;
                }
            } elseif ($request->class == 'four') {
                if (!empty($percentages_coming->where('class', 'five')->first())) {
                    if (!empty($percentages_coming->where('class', 'three')->first())) {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_coming->where('class', 'three')->first()->percentage) ? 1 : 2;
                    } elseif (!empty($percentages_coming->where('class', 'two')->first())) {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_coming->where('class', 'two')->first()->percentage) ? 1 : 2;
                    } elseif (!empty($percentages_coming->where('class', 'one')->first())) {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_coming->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retValue = ($request->percentage <= $percentages_coming->where('class', 'five')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_coming->where('class', 'three')->first())) {
                    $retValue = ($request->percentage >= $percentages_coming->where('class', 'three')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_coming->where('class', 'two')->first())) {
                    $retValue = ($request->percentage >= $percentages_coming->where('class', 'two')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_coming->where('class', 'one')->first())) {
                    $retValue = ($request->percentage >= $percentages_coming->where('class', 'one')->first()->percentage) ? 1 : 2;
                }
            } elseif ($request->class == 'five') {
                if (!empty($percentages_coming->where('class', 'four')->first())) {
                    $retValue = ($request->percentage >= $percentages_coming->where('class', 'four')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_coming->where('class', 'three')->first())) {
                    $retValue = ($request->percentage >= $percentages_coming->where('class', 'three')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_coming->where('class', 'two')->first())) {
                    $retValue = ($request->percentage >= $percentages_coming->where('class', 'two')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_coming->where('class', 'one')->first())) {
                    $retValue = ($request->percentage >= $percentages_coming->where('class', 'one')->first()->percentage) ? 1 : 2;
                }
            }
            if (!empty($retValue)) {
                if ($retValue == 2) {
                    $notification = array(
                        'message' => 'This tax percentage is invalid.',
                        'alert-type' => 'info'
                    );
                    return redirect()->back()->with($notification);
                }
            }
            if ($request->class == 'one') {
                if (!empty($percentages_used->where('class', 'two')->first())) {
                    $retVal = ($request->percentage <= $percentages_used->where('class', 'two')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_used->where('class', 'three')->first())) {
                    $retVal = ($request->percentage <= $percentages_used->where('class', 'three')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_used->where('class', 'four')->first())) {
                    $retVal = ($request->percentage <= $percentages_used->where('class', 'four')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_used->where('class', 'five')->first())) {
                    $retVal = ($request->percentage <= $percentages_used->where('class', 'five')->first()->percentage) ? 1 : 2;
                }
            } elseif ($request->class == 'two') {
                if (!empty($percentages_used->where('class', 'three')->first())) {
                    if (!empty($percentages_used->where('class', 'one')->first())) {

                        $retVal = ($request->percentage <= $percentages_used->where('class', 'three')->first()->percentage && $request->percentage >= $percentages_used->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'three')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_used->where('class', 'four')->first())) {
                    if (!empty($percentages_used->where('class', 'one')->first())) {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'four')->first()->percentage && $request->percentage >= $percentages_used->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'four')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_used->where('class', 'five')->first())) {
                    if (!empty($percentages_used->where('class', 'one')->first())) {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_used->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'five')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_used->where('class', 'one')->first())) {
                    $retValue = ($request->percentage >= $percentages_used->where('class', 'one')->first()->percentage) ? 1 : 2;
                }
            } elseif ($request->class == 'three') {
                if (!empty($percentages_used->where('class', 'four')->first())) {
                    if (!empty($percentages_used->where('class', 'two')->first())) {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'four')->first()->percentage && $request->percentage >= $percentages_used->where('class', 'two')->first()->percentage) ? 1 : 2;
                    } elseif (!empty($percentages_used->where('class', 'one')->first())) {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'four')->first()->percentage && $request->percentage >= $percentages_used->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'four')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_used->where('class', 'five')->first())) {
                    if (!empty($percentages_used->where('class', 'two')->first())) {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_used->where('class', 'two')->first()->percentage) ? 1 : 2;
                    } elseif (!empty($percentages_used->where('class', 'one')->first())) {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_used->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'five')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_used->where('class', 'two')->first())) {
                    $retValue = ($request->percentage >= $percentages_used->where('class', 'two')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_used->where('class', 'one')->first())) {
                    $retValue = ($request->percentage >= $percentages_used->where('class', 'one')->first()->percentage) ? 1 : 2;
                }
            } elseif ($request->class == 'four') {
                if (!empty($percentages_used->where('class', 'five')->first())) {
                    if (!empty($percentages_used->where('class', 'three')->first())) {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_used->where('class', 'three')->first()->percentage) ? 1 : 2;
                    } elseif (!empty($percentages_used->where('class', 'two')->first())) {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_used->where('class', 'two')->first()->percentage) ? 1 : 2;
                    } elseif (!empty($percentages_used->where('class', 'one')->first())) {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'five')->first()->percentage && $request->percentage >= $percentages_used->where('class', 'one')->first()->percentage) ? 1 : 2;
                    } else {
                        $retVal = ($request->percentage <= $percentages_used->where('class', 'five')->first()->percentage) ? 1 : 2;
                    }
                } elseif (!empty($percentages_used->where('class', 'three')->first())) {
                    $retValue = ($request->percentage >= $percentages_used->where('class', 'three')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_used->where('class', 'two')->first())) {
                    $retValue = ($request->percentage >= $percentages_used->where('class', 'two')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_used->where('class', 'one')->first())) {
                    $retValue = ($request->percentage >= $percentages_used->where('class', 'one')->first()->percentage) ? 1 : 2;
                }
            } elseif ($request->class == 'five') {
                if (!empty($percentages_used->where('class', 'four')->first())) {
                    $retVal = ($request->percentage >= $percentages_used->where('class', 'four')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_used->where('class', 'three')->first())) {
                    $retVal = ($request->percentage >= $percentages_used->where('class', 'three')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_used->where('class', 'two')->first())) {
                    $retVal = ($request->percentage >= $percentages_used->where('class', 'two')->first()->percentage) ? 1 : 2;
                } elseif (!empty($percentages_used->where('class', 'one')->first())) {
                    $retVal = ($request->percentage >= $percentages_used->where('class', 'one')->first()->percentage) ? 1 : 2;
                }
            }
            if (!empty($retVal)) {
                if ($retVal == 2) {
                    $notification = array(
                        'message' => 'This tax percentage is invalid.',
                        'alert-type' => 'info'
                    );
                    return redirect()->back()->with($notification);
                }
            }

            if ($tax_percentage_coming) {
                DB::beginTransaction();
                try {
                    $tax_percentage_coming->forceDelete();
                    if ($tax_percentage_coming->decision) {
                        Storage::disk('public')->delete($tax_percentage_coming['decision']);
                    }

                    $tax_percentage = TaxPercentage::createComingPercentage($request);

                    if ($tax_percentage_used) {
                        TaxPercentage::updateUsedPercentage($tax_percentage_used, $implementation_date);
                    }

                    DB::commit();
                    event(new ChangeTaxPercentage($tax_percentage));
                } catch (Throwable $e) {
                    DB::rollBack();
                    throw $e;
                }
                $notification = array(
                    'message' => "Deleted tax percentage which would have been used, and added new tax percentage, will start using from $request->implementation_date .",
                    'alert-type' => 'success'
                );
                return redirect()->route('all_percentage')->with($notification);
            }

            $tax_percentage = TaxPercentage::createComingPercentage($request);

            if ($tax_percentage_used) {
                TaxPercentage::updateUsedPercentage($tax_percentage_used, $implementation_date);
            }

            event(new ChangeTaxPercentage($tax_percentage));
            $notification = array(
                'message' => "added new tax percentage, and will start using from $request->implementation_date .",
                'alert-type' => 'success'
            );
            return redirect()->route('all_percentage')->with($notification);
        }

        $notification = array(
            'message' => 'This date is invalid.',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function storePreparated(Request $request, $class)
    // {
    //     $this->authorize('tax-percentage.create');

    //     $request = $request->merge([
    //         'class' => $class,
    //     ]);
    //     $request->validate([
    //         'class' => ['required', 'string', 'in:one,two,three,four,five'],
    //         'percentage' => ['required', 'numeric', 'max:100',],
    //         'decision' => ['required', 'mimes:pdf', 'max:5150'],
    //         'implementation_date' => ['required', 'date'],
    //     ]);
    //     $implementation_date = now()->setDateFrom($request->implementation_date);

    //     if (($implementation_date->day == '01') && ($implementation_date > Carbon::now())) {

    //         $tax_percentage_preparated = TaxPercentage::where('class', $request->class)->where('status', 'preparated')->first();
    //         $tax_percentage_coming = TaxPercentage::where('class', $request->class)->where('status', 'coming')->first();

    //         if ($tax_percentage_preparated) {
    //             DB::beginTransaction();
    //             try {
    //                 $tax_percentage_preparated->forceDelete();
    //                 if ($tax_percentage_preparated->decision) {
    //                     Storage::disk('public')->delete($tax_percentage_preparated['decision']);
    //                 }

    //                 TaxPercentage::createPreparatedPercentage($request);

    //                 DB::commit();
    //             } catch (Throwable $e) {
    //                 DB::rollBack();
    //                 throw $e;
    //             }
    //             $notification = array(
    //                 'message' => "Deleted previous tax percentage, and added new tax percentage from class $request->class.",
    //                 'alert-type' => 'success'
    //             );
    //             return redirect()->back()->with($notification);
    //         }

    //         TaxPercentage::createComingPercentage($request);

    //         $notification = array(
    //             'message' => "added new tax percentage from class $request->class.",
    //             'alert-type' => 'success'
    //         );
    //         return redirect()->back()->with($notification);
    //     }

    //     $notification = array(
    //         'message' => 'This date is invalid.',
    //         'alert-type' => 'info'
    //     );
    //     return redirect()->back()->with($notification);
    // }




    // public function store1(Request $request, $class)
    // {
    //     $this->authorize('tax-percentage.create');

    //     $request = $request->merge([
    //         'class' => $class,
    //     ]);
    //     $request->validate([
    //         'class' => ['required', 'string', 'in:one,two,three,four,five'],
    //         'percentage' => ['required', 'numeric', 'max:100',],
    //         'decision' => ['required', 'mimes:pdf', 'max:5150'],
    //         'implementation_date' => ['required', 'date'],
    //     ]);
    //     // $implementation_date = now()->setDateFrom($request->implementation_date);
    //     $implementation_date = Carbon::createFromFormat('Y-m-d', $request->implementation_date);

    //     if (($implementation_date->day == '01') && ($implementation_date > Carbon::now())) {

    //         $tax_percentage_coming = TaxPercentage::where('class', $request->class)->where('status', 'coming')->first();
    //         $tax_percentage_used = TaxPercentage::where('class', $request->class)->where('status', 'used')->first();

    //         if ($tax_percentage_coming) {
    //             DB::beginTransaction();
    //             try {
    //                 $tax_percentage_coming->forceDelete();
    //                 if ($tax_percentage_coming->decision) {
    //                     Storage::disk('public')->delete($tax_percentage_coming['decision']);
    //                 }

    //                 TaxPercentage::createComingPercentage($request);

    //                 if ($tax_percentage_used) {
    //                     TaxPercentage::updateUsedPercentage($tax_percentage_used,$implementation_date);
    //                 }

    //                 DB::commit();
    //             } catch (Throwable $e) {
    //                 DB::rollBack();
    //                 throw $e;
    //             }
    //             $notification = array(
    //                 'message' => "Deleted tax percentage which would have been used, and added new tax percentage, will start using from $request->implementation_date .",
    //                 'alert-type' => 'info'
    //             );
    //             return redirect()->back()->with($notification);
    //         }

    //         TaxPercentage::createComingPercentage($request);

    //         if ($tax_percentage_used) {
    //             TaxPercentage::updateUsedPercentage($tax_percentage_used, $implementation_date);
    //         }

    //         $notification = array(
    //             'message' => "added new tax percentage, and will start using from $request->implementation_date .",
    //             'alert-type' => 'info'
    //         );
    //         return redirect()->back()->with($notification);
    //     }

    //     $notification = array(
    //         'message' => 'This date is invalid.',
    //         'alert-type' => 'info'
    //     );
    //     return redirect()->back()->with($notification);
    // }
}
