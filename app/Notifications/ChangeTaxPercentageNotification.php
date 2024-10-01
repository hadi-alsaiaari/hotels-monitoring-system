<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeTaxPercentageNotification extends Notification
{
    use Queueable;

    protected $tax_percentage;
    /**
     * Create a new event instance.
     */
    public function __construct($tax_percentage)
    {
        $this->tax_percentage = $tax_percentage;
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
        $tax_percentage = $this->tax_percentage;
        $class = $tax_percentage->class;
        $percentage = $tax_percentage->percentage;
        $implementation_date = $tax_percentage->implementation_date;
        
        return [
            'body' => "The $class star hotel tax percentage has changed %$percentage from $implementation_date.",
            'icon' => 'fas fa-file',
            'url' => url('/hotle/dashboard'),
            'id' => null,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        $tax_percentage = $this->tax_percentage;
        $class = $tax_percentage->class;
        $percentage = $tax_percentage->percentage;
        $implementation_date = $tax_percentage->implementation_date;

        return new BroadcastMessage([
            'body' => "The $class star hotel tax percentage has changed %$percentage from $implementation_date.",
            'icon' => 'fas fa-file',
            'url' => url('/hotle/dashboard'),
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
