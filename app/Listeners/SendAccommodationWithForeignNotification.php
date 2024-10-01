<?php

namespace App\Listeners;

use App\Models\TouristPolice;
use App\Notifications\AccommodationWithForeignNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAccommodationWithForeignNotification
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
        $number_foreign = $event->number_foreign;
        $accommodation = $event->accommodation;

        $ability = 'guests.view';
        $users = TouristPolice::getUsersHaveAbility('t-p', $ability);
        Notification::send($users, new AccommodationWithForeignNotification($accommodation, $number_foreign));
    }
}
