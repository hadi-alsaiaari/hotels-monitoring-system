<?php

namespace App\Listeners;

use App\Models\TourismOffice;
use App\Notifications\FinshAddingRoomsNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendFinshAddingRoomsNotification
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

        $ability = 'hotel-requests.reply';
        $users = TourismOffice::getUsersHaveAbility('t-o', $ability);
        Notification::send($users, new FinshAddingRoomsNotification($hotel));
    }
}
