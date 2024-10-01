<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateNewUserNotification extends Notification
{
    use Queueable;
    
    // protected $tourism_office;
    protected $password;
    protected $full_name;
    protected $url;
    /**
     * Create a new notification instance.
     */
    public function __construct($full_name, $password, $url)
    {
        $this->full_name = $full_name;
        $this->password = $password;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Your account has been created.")
            ->greeting("Hi {$this->full_name},")
            ->line("Your account in the web application has been created.")
            ->line("Don't tell anyone the password.")
            ->line("The password is: {$this->password} , please reset password!")
            ->action('Visit Website', url($this->url))
            ->line('Thank you for commitment to the instructions');
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
