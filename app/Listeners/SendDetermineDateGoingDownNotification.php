<?php

namespace App\Listeners;

use App\Models\HotelOwner;
use App\Models\HotelUser;
use App\Notifications\DetermineDateGoingDownNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDetermineDateGoingDownNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $hotel = $event->hotel;
        $date = $event->date;

        $hotel_owner = HotelUser::where('user_of_hotel_id', '=', $hotel->hotel_owner->id)->where('user_of_hotel_type', '=', "App\Models\HotelOwner")->first();
            
        if ($hotel_owner) {
            $hotel->license = 'processing';
            $hotel->save();
            
            $hotel_owner->notify(new DetermineDateGoingDownNotification($hotel, $date));
        }
    }
}
