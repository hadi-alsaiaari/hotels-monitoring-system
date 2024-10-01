<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 
        'tax_value', 
        'payment_status',
        'accommodation_id',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
