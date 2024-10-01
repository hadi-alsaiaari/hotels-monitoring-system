<?php

namespace App\Jobs;

use App\Models\Accommodation;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AccommodationEndDay implements ShouldQueue
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
        $day =  now();
        $accommodations = Accommodation::whereday('created_at', '<>', $day)->where('departure_at', null)->get();
        if (!empty($accommodations[0])) {
            $day = $day->subRealDay();
            $departure_at = $day->year . '-' . $day->month . '-' . $day->day . ' 23:59:59';
            foreach ($accommodations as $key => $accommodation) {
                $accommodation->update([
                    'departure_at' => $departure_at,
                ]);
                $accommodation->guestsWhendpar()->update([
                    'departure_at' => $departure_at,
                ]);
            }
            
        }

        
    }
}
