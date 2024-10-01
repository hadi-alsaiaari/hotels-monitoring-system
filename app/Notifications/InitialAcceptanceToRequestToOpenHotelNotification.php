<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InitialAcceptanceToRequestToOpenHotelNotification extends Notification
{
    use Queueable;

    protected $hotel;
    protected $money;
    protected $account;
    
    /**
     * Create a new notification instance.
     */
    public function __construct($hotel, $money, $account)
    {
        $this->hotel = $hotel;
        $this->money = $money;
        $this->account = $account;
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
        return (new MailMessage)
            ->subject("The request to open the {$this->hotel->trade_name} hotel has received the initial acceptance.")
            ->greeting("Hi {$owner->identity->full_name},")
            ->line("The request to open the {$this->hotel->trade_name} hotel has received the initial acceptance.")
            ->line("The calss of your hotel is {$this->hotel->class}.")
            ->line("Please pay {$this->money} Yemeni riyals for license issuance fee to Tourism Office account. The account number in Central Bank: {$this->account}.")
            ->action('To Visit Hotel Page', url("/hotel/instanc/$this->hotel->id"))
            ->line('Thank you for commitment to the instructions');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'body' => "The calss of your hotel is {$this->hotel->class}. Please pay {$this->money} Yemeni riyals for license issuance fee to Tourism Office account. The account number in Central Bank: {$this->account}.",
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
            'body' => "The calss of your hotel is {$this->hotel->class}. Please pay {$this->money} Yemeni riyals for license issuance fee to Tourism Office account. The account number in Central Bank: {$this->account}.",
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
