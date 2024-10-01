<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaxesMonthlyReadyNotification extends Notification
{
    use Queueable;

    protected $year;
    protected $month;
    /**
     * Create a new notification instance.
     */
    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
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
        $year = $this->year;
        $month = $this->month;

        return [
            'body' => "The tax erport for month $month of $year is ready.",
            'icon' => 'fas fa-file',
            'url' => url('/hotel/dashboard'),
            'id' => 0,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        $year = $this->year;
        $month = $this->month;

        return new BroadcastMessage([
            'body' => "The tax erport for month $month of $year is ready.",
            'icon' => 'fas fa-file',
            'url' => url('/hotel/dashboard'),
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
