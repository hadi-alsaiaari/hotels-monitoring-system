<?php

namespace App\Notifications;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccommodationWithWantedPeopleNotification extends Notification
{
    use Queueable;

    protected $accommodation;
    protected $number_wanted_people;

    /**
     * Create a new notification instance.
     */
    public function __construct($accommodation, $number_wanted_people)
    {
        $this->accommodation = $accommodation;
        $this->number_wanted_people = $number_wanted_people;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        if (class_basename($notifiable) == 'SecurityDepartmentOffice') {
            $dashboard = 's-d-o';
        } else {
            $dashboard = 't-p';
        }
        
        $hotel = Hotel::findOrFail(Room::findOrFail($this->accommodation->room_id)->hotel_id);
        $number_wanted_people = $this->number_wanted_people;
        $number_accommodation = $this->accommodation->number_accommodation;
        return [
            'body' => "There are $number_wanted_people potential wanted people in $hotel->trade_name hotel to book $number_accommodation.",
            'icon' => 'fas fa-file',
            'url' => url("/$dashboard/accommodation"),
            'id' => $this->accommodation->id,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        if (class_basename($notifiable) == 'SecurityDepartmentOffice') {
            $dashboard = 's-d-o';
        } else {
            $dashboard = 't-p';
        }
        
        $hotel = Hotel::findOrFail(Room::findOrFail($this->accommodation->room_id)->hotel_id);
        $number_wanted_people = $this->number_wanted_people;
        $number_accommodation = $this->accommodation->number_accommodation;

        return new BroadcastMessage([
            'body' => "There are $number_wanted_people potential wanted people in $hotel->trade_name hotel to book $number_accommodation.",
            'icon' => 'fas fa-file',
            'url' => url("/$dashboard/accommodation"),
            'id' => $this->accommodation->id,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
