<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccommodationWithResidentialPermit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $accommodation;
    public $residential_permit;
    
    /**
     * Create a new event instance.
     */
    public function __construct($accommodation, $residential_permit)
    {
        $this->accommodation = $accommodation;
        $this->residential_permit = $residential_permit;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
