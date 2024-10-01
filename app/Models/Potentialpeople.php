<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Potentialpeople extends Pivot
{
    use HasFactory;

    protected $table = 'potentialpeoples';

    public $timestamps = false;

    const CREATED_AT = 'detection_at';

    protected $primaryKey = ['accommodation_details_id', 'wanted_people_id'];

    public $incrementing = false;

    // public function guest()
    // {
    //     return $this->belongsTo(Guest::class);
    // }
    // public function accommodation()
    // {
    //     return $this->belongsTo(Accommodation::class);
    // }

    public function wanted_people()
    {
        return $this->belongsTo(WantedPeople::class);
    }
    public function accommodation_details()
    {
        return $this->belongsTo(AccommodationDetails::class);
    }
}
