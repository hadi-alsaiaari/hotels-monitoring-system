<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockHotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_activity_rule_id',
        'hotel_id',
        'body',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
