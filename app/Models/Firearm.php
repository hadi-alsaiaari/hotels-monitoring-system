<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firearm extends Model
{
    use HasFactory;

    protected $fillable = [
        'firearm_serial_number',
        'firearm_type',
        'license_type',
        'license_number',
    ];

    public static function createOrGetFirearm($firearms, $order_guest_firearm){
        $firearm = Firearm::where('firearm_serial_number', $firearms[$order_guest_firearm]['firearmSerialNumber'])->where('firearm_type', $firearms[$order_guest_firearm]['firearmType'])->first();
        if(!$firearm){
            $firearm = Firearm::create([
                'firearm_serial_number' => empty($firearms[$order_guest_firearm]['firearmSerialNumber']) ? '' : $firearms[$order_guest_firearm]['firearmSerialNumber'],
                'firearm_type' => empty($firearms[$order_guest_firearm]['firearmType']) ? '' : $firearms[$order_guest_firearm]['firearmType'],
                'license_type' => empty($firearms[$order_guest_firearm]['licenseType']) ? '' : $firearms[$order_guest_firearm]['licenseType'],
                'license_number' => empty($firearms[$order_guest_firearm]['licenseNumber']) ? null : $firearms[$order_guest_firearm]['licenseNumber'],
                
            ]);
        }
        return $firearm;
    }

    public function accommodations()
    {
        return $this->belongsToMany(Accommodation::class, 'accommodation_details', 'firearm_id', 'accommodation_id')
            ->withPivot([
                'id', 'hotel_system_booking_details_id', 'guest_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
            ]);
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'accommodation_details', 'firearm_id', 'guest_id')
            ->withPivot([
                'id', 'hotel_system_booking_details_id', 'accommodation_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
            ]);
    }

    public function check_firearm()
    {
        return $this->belongsToMany(Accommodation::class, 'accommodation_details', 'firearm_id', 'accommodation_id')
            ->withPivot([
                'id', 'hotel_system_booking_details_id', 'guest_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
            ])->wherePivotNull('departure_at');
    }
}
