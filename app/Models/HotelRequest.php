<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'field_landing_report',
        'field_landing_at',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
