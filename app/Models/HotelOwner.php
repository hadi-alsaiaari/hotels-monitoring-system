<?php

namespace App\Models;

use App\Traits\HasIdentity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelOwner extends Model
{
    use HasFactory, SoftDeletes, HasIdentity;

    protected $fillable = [
        'hotel_id' ,
        'street_address',
        'city',
        'governorate',
        'personal_photo',
    ];
    
    // public function identity(){
    //     return $this->morphOne('App\Models\Identity', 'person');
    // }

    public function hotel_user(){
        return $this->morphOne('App\Models\HotelUser', 'user_of_hotel');
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function hotel()
    {
        return Hotel::find($this->hotel_id);
    }

    public function phone_numbers()
    {
        return $this->morphMany(PhoneNumber::class, 'phone');
    }
}
