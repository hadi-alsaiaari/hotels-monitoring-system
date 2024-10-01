<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccommodationWithWantedPeople
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $accommodation, $number_wanted_people, $type_wanted_people_count;
    /**
     * Create a new event instance.
     */
    public function __construct($accommodation, $number_wanted_people, $type_wanted_people_count)
    {
        $this->accommodation = $accommodation;
        $this->number_wanted_people = $number_wanted_people;
        $this->type_wanted_people_count = $type_wanted_people_count;
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
