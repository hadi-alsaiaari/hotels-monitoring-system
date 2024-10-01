<?php

namespace App\Jobs;

use App\Models\ResidentialPermit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EndResidentialPermitTime implements ShouldQueue
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
        $day = now();
        $residential_permits = ResidentialPermit::where('status', 'not_use')->get();
        foreach ($residential_permits as $key => $residential_permit) {
            $days_number = $residential_permit->days_number;
            $created_at = $residential_permit->created_at;
            $created_at = $created_at->addRealDays($days_number);
            if($created_at > $day){
                $residential_permit->status = 'not_used_expired';
                $residential_permit->save();
            }
        }
        $residential_permits = ResidentialPermit::where('status', 'used')->get();
        foreach ($residential_permits as $key => $residential_permit) {
            $days_number = $residential_permit->days_number;
            $created_at = $residential_permit->created_at;
            $created_at = $created_at->addRealDays($days_number);
            if($created_at > $day){
                $residential_permit->status = 'used_expired';
                $residential_permit->save();
            }
        }
    }
}
