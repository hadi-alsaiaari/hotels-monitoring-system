<?php

namespace App\Models;

use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = [ 'phone_number',];


    public $timestamps = false;

    public function phone(): MorphTo
    {
        return $this->morphTo();
    }
}
