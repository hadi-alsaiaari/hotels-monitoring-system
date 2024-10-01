<?php

namespace App\Jobs;

use App\Models\TaxPercentage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StartNewTaxPercentage implements ShouldQueue
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
        $percentage_useds = TaxPercentage::where('status', 'used')->where('expiry_date', '<>', null)->get(); //'coming','used','old'
        $percentage_comings = TaxPercentage::where('status', 'coming')->get();
        foreach ($percentage_comings as $key => $percentage_coming) {
            foreach ($percentage_useds as $number => $percentage_used) {
                // dd($percentage_used->expiry_date);
                if ($percentage_coming->class == $percentage_used->class && $percentage_used->expiry_date < now()) {
                    ($percentage_useds[$number])->update([
                        'status' => 'old',
                    ]);
                    ($percentage_comings[$key])->update([
                        'status' => 'used',
                    ]);
                }
            }
        }
    }
}
