<?php

namespace App\Listeners;

use App\Models\HotelUser;
use App\Notifications\HotelRenewalLicenseEMNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Query\Builder;

class SendHotelRenewalLicenseEMNotification
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
        $users = HotelUser::whereExists(function (Builder $builder) {
            $x = 'App\Models\HotelExecutiveManager';
            $builder->from('hotel_executive_managers')
                ->whereRaw('hotel_users.user_of_hotel_id = hotel_executive_managers.id AND user_of_hotel_type = ?', [$x])
                ->whereExists(function ($query) {
                    $query->from('hotels')
                        ->whereRaw("hotel_executive_managers.hotel_id = hotels.id AND hotels.status <> ?", ['inactive']);
                });
        })->get();
        Notification::send($users, new HotelRenewalLicenseEMNotification());
    }
}
