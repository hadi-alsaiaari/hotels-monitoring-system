<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FinshAddingRoomsNotification extends Notification
{
    use Queueable;

    protected $hotel;
    /**
     * Create a new notification instance.
     */
    public function __construct($hotel)
    {
        $this->hotel = $hotel;
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
        $owner = $this->hotel->hotel_owner;

        return [
            'body' => "{$owner->identity->full_name} owner of {$this->hotel->trade_name} hotel has completed filling in rooms data. Please determine date going down to hotel place: {$this->hotel->location}.",
            'icon' => 'fas fa-file',
            'url' => url('/t-o/hotel_request'),
            'id' => $this->hotel->id,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        $owner = $this->hotel->hotel_owner;

        return new BroadcastMessage([
            'body' => "{$owner->identity->full_name} owner of {$this->hotel->trade_name} hotel has completed filling in rooms data. Please determine date going down to hotel place: {$this->hotel->location}.",
            'icon' => 'fas fa-file',
            'url' => url('/t-o/hotel_request'),
            'id' => $this->hotel->id,
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
