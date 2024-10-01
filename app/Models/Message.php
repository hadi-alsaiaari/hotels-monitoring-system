<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'conversation_id', 'messaging_account_id', 'body', 'type', 'sender_id', 'sender_name', 'type_message',
    ];

    protected $casts = [
        'body' => 'json',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function messaging_account()
    {
        return $this->belongsTo(MessagingAccount::class)->withDefault([
            'name' => __('User')
        ]);
    }

    public function recipients()
    {
        return $this->belongsToMany(MessagingAccount::class, 'recipients')
            ->withPivot([
                'read_at', 'deleted_at',
            ]);
    }
}
