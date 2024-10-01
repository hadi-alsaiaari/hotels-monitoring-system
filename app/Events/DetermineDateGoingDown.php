<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DetermineDateGoingDown
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $hotel;
    public $date;
    /**
     * Create a new event instance.
     */
    public function __construct($hotel, $date)
    {
        $this->hotel = $hotel;
        $this->date = $date;
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
