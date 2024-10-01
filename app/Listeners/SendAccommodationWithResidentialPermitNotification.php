<?php

namespace App\Listeners;

use App\Models\TouristPolice;
use App\Notifications\AccommodationWithResidentialPermitNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAccommodationWithResidentialPermitNotification
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
        $accommodation = $event->accommodation;
        $residential_permit = $event->residential_permit;
        
        $ability = 'residential-permit.view';
        $users = TouristPolice::getUsersHaveAbility('t-p',$ability);
        Notification::send($users, new AccommodationWithResidentialPermitNotification($accommodation, $residential_permit));
    }
}
