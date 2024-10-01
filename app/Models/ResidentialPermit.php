<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentialPermit extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'status',
        // 'number_permit',
        'manager_name',
        'days_number',
    ];

    public function permit_seekers()
    {
        return $this->belongsToMany(Guest::class, 'permit_seekers')
            ->withPivot([
                'notice'
            ]);
    }

    // public function permit_seekers()
    // {
    //     return $this->hasMany(PermitSeeker::class, 'residential_permit_id');
    // }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }


    protected static function booted()
    {
        static::creating(function(ResidentialPermit $residential_permit) {
            // 202400001, 202400002
            $residential_permit->number_permit = ResidentialPermit::getNextNumberPermit();
        });
    }

    public static function getNextNumberPermit()
    {
        // SELECT MAX(number_permit)
        // FROM residential_permits
        // where (created_at->year = $year)
        $year =  Carbon::now()->year;
        $number_permit = ResidentialPermit::whereYear('created_at', $year)->max('number_permit');// if (nowYear == created_at->year) {number_permit contain value}
        if ($number_permit) { 
            return $number_permit + 1;
        }
        return $year . '00001';
    }
}
