<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HotelLicenseIssuanceFeeNotification extends Notification
{
    use Queueable;

    protected $hotel;
    protected $transfer_deed;
    /**
     * Create a new notification instance.
     */
    public function __construct($hotel, $transfer_deed)
    {
        $this->hotel = $hotel;
        $this->transfer_deed = $transfer_deed;
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

    public function toDatabase($notifiable)
    {
        $owner = $this->hotel->hotel_owner;

        return [
            'body' => "{$owner->identity->full_name} owner of {$this->hotel->trade_name} hotel has paid license issuance fee.",
            'icon' => 'fas fa-file',
            'url' => url('/t-o/hotel_request'),
            'id' => $this->hotel->id,
            // 'transfer_deed' => $this->transfer_deed,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        $owner = $this->hotel->hotel_owner;
        
        return new BroadcastMessage([
            'body' => "{$owner->identity->full_name} owner of {$this->hotel->trade_name} hotel has paid license issuance fee.",
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
