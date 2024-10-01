<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HotelLicenseIssuanceFee
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $hotel;
    public $transfer_deed;
    /**
     * Create a new event instance.
     */
    public function __construct($hotel, $transfer_deed)
    {
        $this->hotel = $hotel;
        $this->transfer_deed = $transfer_deed;
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
