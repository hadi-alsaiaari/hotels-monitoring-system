<?php

namespace App\Events;

use App\Models\Message;
use App\Models\MessagingAccount;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class MessageCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Message
     */
    public $message;

    /**
     * Create a new event instance.
     * 
     * @param \App\Models\Message $message
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $user = Auth::user();
        $messaging_account = MessagingAccount::getMessagingAccount($user);
        $other_user = $this->message->conversation->participants()
            ->where('messaging_account_id', '<>', $messaging_account->id)
            ->first();
            
        return new PresenceChannel('Messenger.' . $other_user->id);
    }
    
    public function broadcastAs()
    {
        return 'new-message';
    }
}
