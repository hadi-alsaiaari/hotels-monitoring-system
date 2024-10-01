<?php

namespace App\Listeners;

use App\Models\SecurityDepartmentOffice;
use App\Models\TouristPolice;
use App\Notifications\AccommodationWithWantedPeopleNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAccommodationWithWantedPeopleNotification
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
        $number_wanted_people = $event->number_wanted_people;
        $accommodation = $event->accommodation;
        $type_wanted_people_count = $event->type_wanted_people_count;
        $ability = 'wanted-people.view';
        if ($type_wanted_people_count[0] == 'App\Models\TouristPolice') {
            $users = TouristPolice::getUsersHaveAbility('t-p', $ability);
            Notification::send($users, new AccommodationWithWantedPeopleNotification($accommodation, $number_wanted_people[0]));
        }
        if ($type_wanted_people_count[1] == 'App\Models\SecurityDepartmentOffice') {
            $users = SecurityDepartmentOffice::getUsersHaveAbility('', $ability);
            Notification::send($users, new AccommodationWithWantedPeopleNotification($accommodation, $number_wanted_people[1]));
        }
    }
}
