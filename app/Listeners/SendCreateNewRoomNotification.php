<?php

namespace App\Listeners;

use App\Models\TourismOffice;
use App\Notifications\CreateNewRoomNotification;
use Illuminate\Support\Facades\Notification;

class SendCreateNewRoomNotification
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
        $room = $event->room;
        $hotel_name = $event->hotel_name;

        $ability = 'hotels.view';
        $users = TourismOffice::getUsersHaveAbility('t-o', $ability);
        Notification::send($users, new CreateNewRoomNotification($room, $hotel_name));
    }
}
