<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Participant extends Pivot
{
    use HasFactory;

    protected $table = 'permit_seekers';

    public $incrementing = true;

    public $timestamps = true;

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function residential_permit()
    {
        return $this->belongsTo(ResidentialPermit::class);
    }
}
