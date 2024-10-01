<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccommodationWithForeign
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $accommodation;
    public $number_foreign;
    /**
     * Create a new event instance.
     */
    public function __construct($accommodation, $number_foreign)
    {
        // dd('sdsd');
        $this->accommodation = $accommodation;
        $this->number_foreign = $number_foreign;
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
