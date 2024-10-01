<?php

namespace App\Listeners;

use App\Models\TourismOffice;
use App\Notifications\UpdateRoomNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendUpdateRoomNotification
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
        Notification::send($users, new UpdateRoomNotification($room, $hotel_name));
    }
}
