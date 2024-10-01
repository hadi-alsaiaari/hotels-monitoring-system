<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateNewRoomNotification extends Notification
{
    use Queueable;

    protected $room;
    protected $hotel_name;
    /**
     * Create a new event instance.
     */
    public function __construct($room, $hotel_name)
    {
        $this->room = $room;
        $this->hotel_name = $hotel_name;
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
        $room = $this->room;
        $hotel_name = $this->hotel_name;
        $number = $room->number;
        $price = $room->price;
        return [
            'body' => "Create new room in $hotel_name hotel with number of room is $number and price of room $price.",
            'icon' => 'fas fa-file',
            'url' => url('/t-o/dashboard'),
            'id' => null,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        $room = $this->room;
        $hotel_name = $this->hotel_name;
        $number = $room->number;
        $price = $room->price;
        return new BroadcastMessage([
            'body' => "Create new room in $hotel_name hotel with number of room is $number and price of room $price.",
            'icon' => 'fas fa-file',
            'url' => url('/t-o/dashboard'),
            'id' => null,
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
