<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hotel_owner_id',
        'hotel_email',
        'trade_name',
        'name_owner_building',
        'situation',
        'website',
        'hotel_governorate',
        'hotel_directoration',
        'hotel_city',
        'hotel_street_address',
        'fax',
        'class',
        'operator_management',
        'number_of_employees',
        'yemeni_employee',
        'commercial_record',
        'building_property',
        'personal_card',
        'status',
        'license',
    ];

    protected $appends = [
        'location',
    ];

    public function getLocationAttribute()
    {
        return $this->hotel_governorate . ' - ' . $this->hotel_directoration . ' - ' . $this->hotel_city . ' - ' . $this->hotel_street_address;
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class,);
    }

    public function hotel_owner()
    {
        return $this->belongsTo(HotelOwner::class);
    }

    public function hotel_executive_managers()
    {
        return $this->hasMany(HotelExecutiveManager::class);
    }

    public function hotel_executive_manager()
    {
        return $this->hasOne(HotelExecutiveManager::class);
    }

    public function hotel_receptionists()
    {
        return $this->hasMany(HotelReceptionist::class);
    }

    public function phone_numbers()
    {
        return $this->morphMany(PhoneNumber::class, 'phone');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    public function monthly_taxes()
    {
        return $this->hasMany(MonthlyTax::class);
    }

    public function block_hotel()
    {
        return $this->hasOne(BlockHotel::class);
    }

    public function hotel_request()
    {
        return $this->hasOne(HotelRequest::class);
    }
}
