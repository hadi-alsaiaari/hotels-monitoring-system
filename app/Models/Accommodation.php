<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'total_price',
        'tax',
        'notice',
        'arrival_at',
        'departure_at',
        'hotel_system_booking_id',
        'room_id',
        'hotel_id',
        'hotel_receptionist_id',
        'expected_departure_time',
        'residential_permit_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'arrival_at' => 'datetime',
        'departure_at' => 'datetime',
        'expected_departure_time' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function (Accommodation $accommodation) {
            // 202401000001, 202401000002
            $accommodation->number_accommodation = Accommodation::getNextNumberAccommodation();
        });
    }

    public function hotel_receptionist()
    {
        return $this->belongsTo(HotelReceptionist::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function accommodation_details()
    {
        return $this->hasMany(AccommodationDetails::class);
    }

    public function residential_permit()
    {
        return $this->belongsTo(ResidentialPermit::class);
    }

    public function tax()
    {
        return $this->hasOne(Tax::class);
    }

    public function firearms()
    {
        return $this->belongsToMany(Firearm::class, 'accommodation_details', 'accommodation_id', 'firearm_id',)
            ->withPivot([
                'id', 'hotel_system_booking_details_id', 'guest_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
            ]);
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'accommodation_details', 'accommodation_id', 'guest_id')
            ->withPivot([
                'id', 'hotel_system_booking_details_id', 'firearm_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
            ]);
    }

    public function guestsWhendpar()
    {
        return $this->belongsToMany(Guest::class, 'accommodation_details', 'accommodation_id', 'guest_id')
            ->withPivot([
                'id', 'hotel_system_booking_details_id', 'firearm_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
            ])->wherePivotNull('departure_at');
    }

    public function lastGuest()
    {
        return $this->belongsToMany(Guest::class, 'accommodation_details', 'accommodation_id', 'guest_id')->latest()
            ->withPivot([
                'id', 'hotel_system_booking_details_id', 'firearm_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
            ]);
    }

    public function firstGuest()
    {
        return $this->belongsToMany(Guest::class, 'accommodation_details', 'accommodation_id', 'guest_id')->oldest()
            ->withPivot([
                'id', 'hotel_system_booking_details_id', 'firearm_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
            ]);
    }

    public static function getNextNumberAccommodation()
    {
        $month =  Carbon::now()->month;
        $number_accommodation = Accommodation::whereMonth('created_at', $month)->max('number_accommodation'); // if (nowMonth == created_at->month) {number_permit contain value}
        if ($number_accommodation) {
            return $number_accommodation + 1;
        }
        $year =  Carbon::now()->year;
        $year_month = $year . $month;
        return $year_month . '000001';
    }

    public static function createNewAccommodation($hotel_receptionist_id, $hotel_id, $hotel_system_booking_id, $price, $notice='', $arrival_at, $expected_departure_time, $room_id, $residential_permit_id = null)
    {
        return Accommodation::create([
            'hotel_receptionist_id' => $hotel_receptionist_id,
            'hotel_system_booking_id' => $hotel_system_booking_id,
            'hotel_id' => $hotel_id,
            'room_id' => $room_id,
            'residential_permit_id' => $residential_permit_id,
            'price' => $price,
            'notice' => $notice,
            'arrival_at' => $arrival_at,
            'expected_departure_time' => $expected_departure_time,
        ]);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'hotel_id' => null,
            'price_max' => null,
            'price_min' => null,
            'is_residential_permit' => null,
            'start_at' => null,
            'end_at' => null,
            'number_accommodation' => null,
        ], $filters);
        $end_at = $options['end_at'];
        $date_accommodation['start_at'] = $options['start_at'];
        $date_accommodation['end_at'] = "$end_at 23:59:59";
        $price['price_max'] = $options['price_max'];
        $price['price_min'] = $options['price_min'];
        
        if (!empty($date_accommodation['start_at']) && !empty($end_at)) {
            $builder->when($date_accommodation, function ($query, $value) {
                return $query->whereBetween('arrival_at', [$value['start_at'], $value['end_at']]);
            });
        } else {
            $builder->when($date_accommodation['start_at'], function ($builder, $value) {
                $builder->where('arrival_at', '>=', $value);
            });
            $builder->when($end_at, function ($builder, $value) {
                $value = "$value 23:59:59";
                $builder->where('arrival_at', '<=', $value);
            });
        }
        $builder->when($options['is_residential_permit'], function ($builder, $value) {
            if ($value == 1) {
                $builder->where('residential_permit_id', '<>', null);
            } else {
                $builder->where('residential_permit_id', '=', null);
            }
        });
        if ($price['price_max'] && $price['price_min']) {
            $builder->when($price, function ($builder, $value) {
                $builder->whereBetween('price', [$value['price_min'], $value['price_max']]);
            });
        } else {
            $builder->when($options['price_max'], function ($builder, $value) {
                $builder->where('price', '<=', $value);
            });
            $builder->when($options['price_min'], function ($builder, $value) {
                $builder->where('price', '>=', $value);
            });
        }
        $builder->when($options['hotel_id'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('rooms')
                    ->whereRaw("rooms.id = accommodations.room_id AND rooms.hotel_id = ?", [$value]);
            });
        });
        $builder->when($options['number_accommodation'], function ($builder, $value) {
            $builder->where('number_accommodation', '=', $value);
        });
    }
}
