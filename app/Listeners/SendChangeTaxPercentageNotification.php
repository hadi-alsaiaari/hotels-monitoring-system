<?php

namespace App\Listeners;

use App\Models\HotelExecutiveManager;
use App\Models\HotelUser;
use App\Notifications\ChangeTaxPercentageNotification;
use App\Notifications\CreateNewRoomNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\Builder;

class SendChangeTaxPercentageNotification
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
        $tax_percentage = $event->tax_percentage;
        $class = $tax_percentage->class;
        $users = HotelUser::when($class, function (Builder $builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $x = 'App\Models\HotelExecutiveManager';
                $query->from('hotel_executive_managers')
                    ->whereRaw('hotel_users.user_of_hotel_id = hotel_executive_managers.id AND user_of_hotel_type = ?', [$x])
                    ->whereExists(function ($query) use ($value) {
                        $query->from('hotels')
                            ->whereRaw("hotel_executive_managers.hotel_id = hotels.id AND hotels.class = ?", [$value]);
                    });
            });
        })->get();

        Notification::send($users, new ChangeTaxPercentageNotification($tax_percentage));
    }
}
