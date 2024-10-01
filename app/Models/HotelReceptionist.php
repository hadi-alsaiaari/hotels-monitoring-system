<?php

namespace App\Models;

use App\Traits\HasIdentity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelReceptionist extends Model
{
    use HasFactory, SoftDeletes, HasIdentity;
    
    protected $fillable = [
        'hotel_id', 'messaging_account_id', 'hotel_executive_manager_id', 'deleted_at'
    ];

    // public function identity(){
    //     return $this->morphOne('App\Models\Identity', 'person');
    // }

    public function hotel_user(){
        return $this->morphOne('App\Models\HotelUser', 'user_of_hotel');
    }

    public function hotel_executive_manager()
    {
        return $this->belongsTo(HotelExecutiveManager::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }
}
