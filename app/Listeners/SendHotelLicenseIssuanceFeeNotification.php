<?php

namespace App\Listeners;

use App\Models\TourismOffice;
use App\Notifications\HotelLicenseIssuanceFeeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendHotelLicenseIssuanceFeeNotification
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
        $transfer_deed = $event->transfer_deed;

        $ability = 'hotel-requests.reply';
        $users = TourismOffice::getUsersHaveAbility('t-o', $ability);
        Notification::send($users, new HotelLicenseIssuanceFeeNotification($hotel, $transfer_deed));
    }
}
