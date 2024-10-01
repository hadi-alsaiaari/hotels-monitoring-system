<?php

namespace App\Listeners;

use App\Models\HotelOwner;
use App\Models\HotelUser;
use App\Notifications\InitialAcceptanceToRequestToOpenHotelNotification;
use App\Notifications\ReplyFalseToRequestToOpenHotelNotification;
use App\Notifications\ReplyTrueToRequestToOpenHotelNotification;
use App\Notifications\ResendHotelLicenseIssuanceFeeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReplyToRequestToOpenHotelNotification
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

        $hotel_owner = HotelUser::where('user_of_hotel_id', '=', $hotel->hotel_owner->id)->where('user_of_hotel_type', '=', "App\Models\HotelOwner")->first();

        $status = $event->status;
        if (($hotel_owner) && $status == true) {
            $hotel->status = 'active';
            $hotel->license = 'valid';
            $hotel->save();
            $hotel_owner->notify(new ReplyTrueToRequestToOpenHotelNotification($hotel));
        } elseif (($hotel_owner) && $status == false) {
            $hotel_owner->notify(new ResendHotelLicenseIssuanceFeeNotification($hotel));
        }
    }
}
