<?php

namespace App\Listeners;

use App\Models\HotelExecutiveManager;
use App\Models\HotelUser;
use App\Notifications\TaxesMonthlyReadyNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendTaxesMonthlyReadyNotification
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
        $year = $event->year;
        $month = $event->month;

        $users = HotelUser::where('user_of_hotel_type', 'App\Models\HotelExecutiveManager')->where('status', 'active')->get();
        Notification::send($users, new TaxesMonthlyReadyNotification($year, $month));
    }
}
