<?php

namespace App\Notifications;

use App\Models\Hotel;
use App\Models\ResidentialPermit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccommodationWithResidentialPermitNotification extends Notification
{
    use Queueable;

    protected $accommodation;
    protected $residential_permit;

    /**
     * Create a new notification instance.
     */
    public function __construct($accommodation, $residential_permit)
    {
        $this->accommodation = $accommodation;
        $this->residential_permit = $residential_permit;
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
        $hotel = Hotel::findOrFail($this->accommodation->hotel_id);
        
        return [
            'body' => "{Residential permit number {$this->residential_permit->number_permit} which contain {$this->residential_permit->permit_seekers_count} people in {$hotel->trade_name} hotel.",
            'icon' => 'fas fa-file',
            'url' => url('/t-p/accommodation'),
            'id' => $this->accommodation->id,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        $hotel = Hotel::findOrFail($this->accommodation->hotel_id);

        return new BroadcastMessage([
            'body' => "{Residential permit number {$this->residential_permit->number_permit} which contain {$this->residential_permit->permit_seekers_count} people in {$hotel->trade_name} hotel.",
            'icon' => 'fas fa-file',
            'url' => url('/t-p/accommodation'),
            'id' => $this->accommodation->id,
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
