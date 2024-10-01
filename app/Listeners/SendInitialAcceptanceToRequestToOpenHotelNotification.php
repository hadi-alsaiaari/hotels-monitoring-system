<?php

namespace App\Listeners;

use App\Models\HotelUser;
use App\Notifications\InitialAcceptanceToRequestToOpenHotelNotification;
use App\Notifications\ReplyFalseToRequestToOpenHotelNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInitialAcceptanceToRequestToOpenHotelNotification
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
        $status = $event->status;
        $money = $event->money;
        $account = $event->account;
        $class = $event->class;
        
        $hotel_owner = HotelUser::where('user_of_hotel_id', '=', $hotel->hotel_owner->id)->where('user_of_hotel_type', '=', "App\Models\HotelOwner")->first();

        if (($hotel_owner) && $status == true) {
            $hotel->class = $class;
            $hotel->license = 'preparation';
            $hotel->save();
            $hotel_owner->notify(new InitialAcceptanceToRequestToOpenHotelNotification($hotel, $money, $account));
        } elseif (($hotel_owner) && $status == false) {
            $hotel->license = 'rejected';
            $hotel->save();
            $hotel_owner->notify(new ReplyFalseToRequestToOpenHotelNotification($hotel));
        }
    }
}
