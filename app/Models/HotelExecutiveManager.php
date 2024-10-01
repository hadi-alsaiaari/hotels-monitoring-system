<?php

namespace App\Models;

use App\Traits\HasIdentity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelExecutiveManager extends Model
{
    use HasFactory, SoftDeletes, HasIdentity;

    protected $fillable = [
        'hotel_id' ,
        'education_level',
        'date_of_work_license',
        'work_license_number',
        'qualification' ,
        'experience_certificate' ,
        'identity_photo' ,
        'messaging_account_id',
        'deleted_at',
    ];

    // public function identity(){
    //     return $this->morphOne('App\Models\Identity', 'person');
    // }

    public function hotel_user(){
        return $this->morphOne('App\Models\HotelUser', 'user_of_hotel');
    }

    public function hotel_receptionists()
    {
        return $this->hasMany(HotelReceptionist::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
