<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'messaging_account_id', 'label', 'type', 'last_message_id', 'joined_at', 'role'
    ];

    public function participants()
    {
        return $this->belongsToMany(MessagingAccount::class, 'participants')
            ->withPivot([
                'joined_at', 'role'
            ]);
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id', 'id');
            // ->latest();
    }

    public function messaging_account()
    {
        return $this->belongsTo(MessagingAccount::class, 'messaging_account_id', 'id');
    }
    
    public function lastMessage()
    {
        return $this->belongsTo(Message::class, 'last_message_id', 'id')
            // ->whereNull('deleted_at')
            ->withDefault([
                'body' => 'Message deleted'
            ]);
    }
}
