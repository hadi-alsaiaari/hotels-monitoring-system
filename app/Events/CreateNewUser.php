<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateNewUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $full_name;
    public $password;
    public $url;
    /**
     * Create a new event instance.
     */
    public function __construct($user, $full_name, $password, $url)
    {
        $this->user = $user;
        $this->full_name = $full_name;
        $this->password = $password;
        $this->url = $url;
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
