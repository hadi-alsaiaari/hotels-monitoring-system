<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResendHotelLicenseIssuanceFeeNotification extends Notification
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
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $owner = $this->hotel->hotel_owner;
        $id = $this->hotel->id;
        return (new MailMessage)
            ->subject("The request to open the {$this->hotel->trade_name} hotel has received the initial acceptance.")
            ->greeting("Hi {$owner->identity->full_name},")
            ->line("The request to open the {$this->hotel->trade_name} hotel has received the initial acceptance.")
            ->line("Please resend license issuance fee document to Tourism Office.")
            ->action('To Visit Hotel Page', url("/hotel/instanc/$id"))
            ->line('Thank you for commitment to the instructions');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'body' => "The request to open the {$this->hotel->trade_name} hotel has received the initial acceptance. Please resend license issuance fee document to Tourism Office.",
            'icon' => 'fas fa-file',
            'url' => url('/hotel/instanc/'),
            'id' => $this->hotel->id,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'body' => "The request to open the {$this->hotel->trade_name} hotel has received the initial acceptance. Please resend license issuance fee document to Tourism Office.",
            'icon' => 'fas fa-file',
            'url' => url('/hotel/tax_monthly'),
            'id' => 0,
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
