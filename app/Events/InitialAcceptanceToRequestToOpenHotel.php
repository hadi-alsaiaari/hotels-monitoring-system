<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InitialAcceptanceToRequestToOpenHotel
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $hotel;
    public $status;
    public $money;
    public $account;
    public $class;
    /**
     * Create a new event instance.
     */
    public function __construct($hotel, $status, $money=0, $account=0, $class='')
    {
        $this->hotel = $hotel;
        $this->status = $status;
        $this->money = $money;
        $this->account = $account;
        $this->class = $class;
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
