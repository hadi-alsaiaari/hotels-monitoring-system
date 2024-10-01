<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DetermineDateGoingDownNotification extends Notification
{
    use Queueable;

    protected $hotel;
    protected $date;
    /**
     * Create a new notification instance.
     */
    public function __construct($hotel, $date)
    {
        $this->hotel = $hotel;
        $this->date = $date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail'];
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $owner = $this->hotel->hotel_owner;
        
        return (new MailMessage)
            ->subject("Determine the date of going down to {$this->hotel->trade_name}")
            ->greeting("Hi {$owner->identity->full_name},")
            ->line("Determine the date of going down to {$this->hotel->trade_name} on the {$this->date} at 09:00 AM.")
            ->line('Thank you for commitment to the instructions');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'body' => "Determine the date of going down to {$this->hotel->trade_name} on the {$this->date} at 09:00 AM.",
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
            'body' => "Determine the date of going down to {$this->hotel->trade_name} on the {$this->date} at 09:00 AM.",
            'icon' => 'fas fa-file',
            'url' => url('/hotel/instanc/'),
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
