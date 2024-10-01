<?php

namespace App\Jobs;

use App\Events\TaxesMonthlyReady;
use App\Models\Hotel;
use App\Models\MonthlyTax;
use App\Models\TaxPercentage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use PDF;

class GenerateReportsTaxMonthly implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $hotels = Hotel::where('status', '<>', 'inactive')->with('hotel_owner.identity')->get();
        $tax_percentages = TaxPercentage::where('status', 'used')->get();
        $totel_taxes = [];
        $datea = now()->subRealMonth();
        $between_date = now()->subRealMonth();
        $start_month = $between_date->year . '-' . $between_date->month . '-' . $between_date->subRealMonth()->setDay('01')->day;
        $between_date = now()->subRealMonth();
        $end_month = $between_date->year . '-' . $between_date->month . '-' . $between_date->addRealMonth()->setDay('01')->subRealDay()->day . ' 23:59:59';
        foreach ($hotels as $key => $hotel) {
            $taxes = $hotel->taxes()->whereBetween('created_at', [$start_month, $end_month])->get();
            $hotel_rooms = $hotel->rooms;
            $percentage_id = $tax_percentages->where('class', $hotel->class)->first()->id;
            $percentage = $tax_percentages->where('class', $hotel->class)->first()->percentage;

            $total_components_accommodation = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $monthli_occupancy_number = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $accommodation_unit_price = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $total_monthly_income_occupancy = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $taxes_owed = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            foreach ($taxes as $number => $tax) {
                $room = $tax->accommodation->room;
                if ($room->type == 'Single') {
                    if ($room->category == 'A') {
                        $monthli_occupancy_number[0] += 1;
                        $total_monthly_income_occupancy[0] += $tax['tax_value'] / $percentage * 100;
                        $taxes_owed[0] += $tax['tax_value'];
                    } else {
                        $monthli_occupancy_number[1] += 1;
                        $total_monthly_income_occupancy[1] += $tax['tax_value'] / $percentage * 100;
                        $taxes_owed[1] += $tax['tax_value'];
                    }
                } elseif ($room->type == 'Double') {
                    if ($room->category == 'A') {
                        $monthli_occupancy_number[2] += 1;
                        $total_monthly_income_occupancy[2] += $tax['tax_value'] / $percentage * 100;
                        $taxes_owed[2] += $tax['tax_value'];
                    } else {
                        $monthli_occupancy_number[3] += 1;
                        $total_monthly_income_occupancy[3] += $tax['tax_value'] / $percentage * 100;
                        $taxes_owed[3] += $tax['tax_value'];
                    }
                } elseif ($room->type == 'Treble') {
                    if ($room->category == 'A') {
                        $monthli_occupancy_number[4] += 1;
                        $total_monthly_income_occupancy[4] += $tax['tax_value'] / $percentage * 100;
                        $taxes_owed[4] += $tax['tax_value'];
                    } else {
                        $monthli_occupancy_number[5] += 1;
                        $total_monthly_income_occupancy[5] += $tax['tax_value'] / $percentage * 100;
                        $taxes_owed[5] += $tax['tax_value'];
                    }
                } elseif ($room->type == 'Apartment') {
                    if ($room->category == 'A') {
                        $monthli_occupancy_number[6] += 1;
                        $total_monthly_income_occupancy[6] += $tax['tax_value'] / $percentage * 100;
                        $taxes_owed[6] += $tax['tax_value'];
                    } else {
                        $monthli_occupancy_number[7] += 1;
                        $total_monthly_income_occupancy[7] += $tax['tax_value'] / $percentage * 100;
                        $taxes_owed[7] += $tax['tax_value'];
                    }
                } elseif ($room->type == 'Suite') {
                    if ($room->category == 'A') {
                        $monthli_occupancy_number[8] += 1;
                        $total_monthly_income_occupancy[8] += $tax['tax_value'] / $percentage * 100;
                        $taxes_owed[8] += $tax['tax_value'];
                    } else {
                        $monthli_occupancy_number[9] += 1;
                        $total_monthly_income_occupancy[9] += $tax['tax_value'] / $percentage * 100;
                        $taxes_owed[9] += $tax['tax_value'];
                    }
                }
            }
            foreach ($hotel_rooms as $counts => $hotel_rooms) {
                if ($hotel_rooms['type'] == 'Single') {
                    if ($hotel_rooms['category'] == 'A') {
                        $total_components_accommodation[0] += 1;
                    } else {
                        $total_components_accommodation[1] += 1;
                    }
                } elseif ($hotel_rooms['type'] == 'Double') {
                    if ($hotel_rooms['category'] == 'A') {
                        $total_components_accommodation[2] += 1;
                    } else {
                        $total_components_accommodation[3] += 1;
                    }
                } elseif ($hotel_rooms['type'] == 'Treble') {
                    if ($hotel_rooms['category'] == 'A') {
                        $total_components_accommodation[4] += 1;
                    } else {
                        $total_components_accommodation[5] += 1;
                    }
                } elseif ($hotel_rooms['type'] == 'Apartment') {
                    if ($hotel_rooms['category'] == 'A') {
                        $total_components_accommodation[6] += 1;
                    } else {
                        $total_components_accommodation[7] += 1;
                    }
                } elseif ($hotel_rooms['type'] == 'Suite') {
                    if ($hotel_rooms['category'] == 'A') {
                        $total_components_accommodation[8] += 1;
                    } else {
                        $total_components_accommodation[9] += 1;
                    }
                }
            }
            for ($i = 0; $i < 10; $i++) {
                if ($total_components_accommodation[$i]) {
                    $total_components_accommodation[10] += $total_components_accommodation[$i];
                    if ($total_monthly_income_occupancy[$i]) {
                        $monthli_occupancy_number[10] += $monthli_occupancy_number[$i];
                        $total_monthly_income_occupancy[10] += $total_monthly_income_occupancy[$i];
                        $taxes_owed[10] += $taxes_owed[$i];
                        $accommodation_unit_price[$i] += $total_monthly_income_occupancy[$i] / $monthli_occupancy_number[$i];
                        $accommodation_unit_price[10] += $total_monthly_income_occupancy[$i] / $monthli_occupancy_number[$i];
                    }
                }
            }
            $totel_taxes['total_components_accommodation'] = $total_components_accommodation;
            $totel_taxes['monthli_occupancy_number'] = $monthli_occupancy_number;
            $totel_taxes['accommodation_unit_price'] = $accommodation_unit_price;
            $totel_taxes['total_monthly_income_occupancy'] = $total_monthly_income_occupancy;
            $totel_taxes['taxes_owed'] = $taxes_owed;


            $pdf = PDF::loadView('tax_report',[
                'hotel' => $hotel,
                'totel_taxes' => $totel_taxes,
                'percentage' => $percentage,
            ]);
            $name_file = $datea->year . '-' . $datea->month . ' ' . $hotel->trade_name;
            $file = $pdf->output();
            $path = "public/taxes/$name_file.pdf";
            Storage::append($path,$file);
            $store_date = now()->subRealMonth();
            $store_dates = now();
            $day = $store_dates->setDate($store_dates->year, $store_dates->month, '01')->subRealDay()->day;
            $store_date = $store_date->setDate($store_date->year, $store_date->month, $day);
            MonthlyTax::create([
                'hotel_id' => $hotel->id,
                'tax_percentage_id' => $percentage_id,
                'total_tax_value' => $totel_taxes['taxes_owed'][10],
                'year_month' => $store_date,
                'hotel_tax_report' => $name_file,
            ]);
        }
        event(new TaxesMonthlyReady($datea->year,$datea->month));
    }
}
