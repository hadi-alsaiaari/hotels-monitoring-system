<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReplyToRequestToOpenHotel
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $hotel;
    public $status;
    /**
     * Create a new event instance.
     */
    public function __construct($hotel, $status)
    {
        $this->hotel = $hotel;
        $this->status = $status;
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
