<?php

namespace App\Listeners;

use App\Notifications\CreateNewUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCreateNewUserNotification
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
        $user = $event->user;
        $full_name = $event->full_name;
        $password = $event->password;
        $url = $event->url;
        
        if ($user) {
            $user->notify(new CreateNewUserNotification($full_name, $password, $url));
        }
    }
}
