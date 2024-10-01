<?php

namespace App\Notifications;

use App\Models\Hotel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class HotelOpeningRequestNotification extends Notification
{
    use Queueable;

    protected $hotel;

    /**
     * Create a new notification instance.
     */
    public function __construct(Hotel $hotel)
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
        // return ['mail', 'database'];
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $owner = $this->hotel->hotel_owner;
        // dd($owner);
        return (new MailMessage)
            ->subject("A new opening hotel request {$this->hotel->trade_name}")
            ->greeting("Hi {$notifiable->name},")
            ->line("A new opening hotel request {$this->hotel->trade_name} created by {$owner->identity->full_name} in {$this->hotel->location}.")
            ->action('View Opening Hotel Request', url('/t-o/hotel_request'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        $owner = $this->hotel->hotel_owner;

        return [
            'body' => "A new opening hotel request {$this->hotel->trade_name} created by {$owner->identity->full_name} in {$this->hotel->location}.",
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
            'body' => "A new opening hotel request {$this->hotel->trade_name} created by {$owner->identity->full_name} in {$this->hotel->location}.",
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
