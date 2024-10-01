<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class MessagingAccount extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'type',
    ];

    public function account_users($type)
    {
        if ($type == 'tourist_police') {
            return $this->hasMany(TouristPolice::class);
        } elseif ($type == 'tourism_office') {
            return $this->hasMany(TourismOffice::class);
        } elseif ($type == 'hotel_executive_manager') {
            return $this->hasMany(HotelExecutiveManager::class);
        } else {
            return $this->hasMany(HotelReceptionist::class);
        }
    }

    public static function getMessagingAccount($user)
    {
        $class_name = class_basename($user);
        
        if ($class_name != 'HotelUser') {
            if (!Gate::allows('messenger.use')) {
                return abort(403);
            }
            $class_name = Str::snake($class_name);
            $messaging_account_user = MessagingAccount::where('type', $class_name)->first();
        } else {
            $hotel_user = $user->user_of_hotel;
            $account_user = $hotel_user->messaging_account_id;
            $messaging_account_user = MessagingAccount::findOrFail($account_user);
        }
        return $messaging_account_user;
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'participants')
            ->latest('last_message_id')
            ->withPivot([
                'role', 'joined_at'
            ]);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'messaging_account_id', 'id');
    }

    public function receivedMessages()
    {
        return $this->belongsToMany(Message::class, 'recipients')
            ->withPivot([
                'read_at', 'deleted_at',
            ]);
    }
}
