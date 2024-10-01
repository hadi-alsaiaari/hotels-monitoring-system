<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AccommodationDetails extends Pivot
{
    use HasFactory;

    protected $table = 'accommodation_details';

    public $timestamps = true;

    protected $primaryKey = 'id';

    public $incrementing = false;

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
        static::creating(function (AccommodationDetails $accommodation_details) {
            // 1, 2, 3...
            $accommodation_details->id = AccommodationDetails::getNextId();
        });
    }
    public static function getNextId()
    {
        $id_accommodation = AccommodationDetails::max('id'); // if (nowMonth == created_at->month) {number_permit contain value}
        if ($id_accommodation) {
            return $id_accommodation + 1;
        }
        return 1;
    }

    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function firearm(): BelongsTo
    {
        return $this->belongsTo(Firearm::class);
    }

    public function companions(): HasMany
    {
        return $this->hasMany(AccommodationDetails::class, 'escort_with', 'id');
    }

    public function came_with(): BelongsTo
    {
        return $this->belongsTo(AccommodationDetails::class, 'escort_with', 'id');
    }

    public function wantedPeoples()
    {
        return $this->belongsToMany(WantedPeople::class, 'potentialpeoples', 'accommodation_details_id', 'wanted_people_id',)
            ->withPivot([
                'detection_at', 'is_same'
            ]);
    }

    public static function addNewGuestToAccommodation($accommodation, $guest_id, $hotel_system_booking_details_id, $escort_with, $firearm_id, $arrival_at, $expected_departure_time)
    {
        $accommodation_details_id = AccommodationDetails::getNextId();
        $accommodation->guests()->attach([
            $guest_id  => [
                'id' => $accommodation_details_id,
                'hotel_system_booking_details_id' => $hotel_system_booking_details_id,
                'escort_with' => $escort_with,
                'firearm_id' => $firearm_id,
                'arrival_at' => $arrival_at,
                'expected_departure_time' => $expected_departure_time,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        return $accommodation_details_id;
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'identity_number' => null,
            'first_name' => null,
            'second_name' => null,
            'third_name' => null,
            'last_name' => null,
            'country' => null,
            'is_firearm' => null,
            'is_escort_with' => null,
            'is_foreigner' => null,
            'is_male' => null,
            'hotel_id' => null,
            'residential_permit_id' => null,
            'start_at' => null,
            'end_at' => null,
            'firearm_serial_number' => null,
            'license_number' => null,
        ], $filters);
        $end_at = $options['end_at'];
        $date_accommodation_details['start_at'] = $options['start_at'];
        $date_accommodation_details['end_at'] = "$end_at 23:59:59";


        $builder->when($options['identity_number'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('guests')
                    ->whereRaw("guests.id = accommodation_details.guest_id")
                    ->whereExists(function ($query) use ($value) {
                        $idetity_num = 'App\Models\Guest';
                        $query->from('identities')
                            ->whereRaw("? = identities.person_type AND guests.id = identities.person_id AND identities.identity_number = ?", [$idetity_num, $value]);
                    });
            });
        });
        $builder->when($options['first_name'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('guests')
                    ->whereRaw("guests.id = accommodation_details.guest_id")
                    ->whereExists(function ($query) use ($value) {
                        $idetity_num = 'App\Models\Guest';
                        $value = "%$value%";
                        $query->from('identities')
                            ->whereRaw("? = identities.person_type AND guests.id = identities.person_id AND identities.first_name LIKE ?", [$idetity_num, $value]);
                    });
            });
        });
        $builder->when($options['second_name'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('guests')
                    ->whereRaw("guests.id = accommodation_details.guest_id")
                    ->whereExists(function ($query) use ($value) {
                        $idetity_num = 'App\Models\Guest';
                        $value = "%$value%";
                        $query->from('identities')
                            ->whereRaw("? = identities.person_type AND guests.id = identities.person_id AND identities.second_name LIKE ?", [$idetity_num, $value]);
                    });
            });
        });
        $builder->when($options['third_name'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('guests')
                    ->whereRaw("guests.id = accommodation_details.guest_id")
                    ->whereExists(function ($query) use ($value) {
                        $idetity_num = 'App\Models\Guest';
                        $value = "%$value%";
                        $query->from('identities')
                            ->whereRaw("? = identities.person_type AND guests.id = identities.person_id AND identities.third_name LIKE ?", [$idetity_num, $value]);
                    });
            });
        });
        $builder->when($options['last_name'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('guests')
                    ->whereRaw("guests.id = accommodation_details.guest_id")
                    ->whereExists(function ($query) use ($value) {
                        $idetity_num = 'App\Models\Guest';
                        $value = "%$value%";
                        $query->from('identities')
                            ->whereRaw("? = identities.person_type AND guests.id = identities.person_id AND identities.last_name LIKE ?", [$idetity_num, $value]);
                    });
            });
        });
        $builder->when($options['country'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('guests')
                    ->whereRaw("guests.id = accommodation_details.guest_id")
                    ->whereExists(function ($query) use ($value) {
                        $idetity_num = 'App\Models\Guest';
                        $query->from('identities')
                            ->whereRaw("? = identities.person_type AND guests.id = identities.person_id AND identities.country = ?", [$idetity_num, $value]);
                    });
            });
        });

        $builder->when($options['is_firearm'], function ($builder, $value) {
            if ($value == 1) {
                $builder->where('firearm_id', '<>', null);
            } else {
                $builder->where('firearm_id', '=', null);
            }
        });
        $builder->when($options['is_escort_with'], function ($builder, $value) {
            if ($value == 1) {
                $builder->where('escort_with', '<>', null);
            } else {
                $builder->where('escort_with', '=', null);
            }
        });
        $builder->when($options['is_foreigner'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('guests')
                    ->whereRaw("guests.id = accommodation_details.guest_id")
                    ->whereExists(function ($query) use ($value) {
                        $idetity_num = 'App\Models\Guest';
                        if ($value == '1') {
                            $value = 'ye';
                            $query->from('identities')
                                ->whereRaw("? = identities.person_type AND guests.id = identities.person_id AND identities.country <> ?", [$idetity_num, $value]);
                        } else {
                            $value = 'ye';
                            $query->from('identities')
                                ->whereRaw("? = identities.person_type AND guests.id = identities.person_id AND identities.country = ?", [$idetity_num, $value]);
                        }
                    });
            });
        });
        $builder->when($options['is_male'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('guests')
                    ->whereRaw("guests.id = accommodation_details.guest_id")
                    ->whereExists(function ($query) use ($value) {
                        $idetity_num = 'App\Models\Guest';
                        if ($value == '1') {
                            $value = 'male';
                            $query->from('identities')
                                ->whereRaw("? = identities.person_type AND guests.id = identities.person_id AND identities.sex = ?", [$idetity_num, $value]);
                        } else {
                            $value = 'female';
                            $query->from('identities')
                                ->whereRaw("? = identities.person_type AND guests.id = identities.person_id AND identities.sex = ?", [$idetity_num, $value]);
                        }
                    });
            });
        });
        $builder->when($options['hotel_id'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('accommodations')
                    ->whereRaw("accommodations.id = accommodation_details.accommodation_id")
                    ->whereExists(function ($query) use ($value) {
                        $query->from('rooms')
                            ->whereRaw("rooms.id = accommodations.room_id AND rooms.hotel_id = ?", [$value]);
                    });
            });
        });
        $builder->when($options['residential_permit_id'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('accommodations')
                    ->whereRaw("accommodations.id = accommodation_details.accommodation_id")
                    ->whereExists(function ($query) use ($value) {
                        $query->from('residential_permits')
                            ->whereRaw("residential_permits.id = accommodations.residential_permit_id AND residential_permits.id = ?", [$value]);
                    });
            });
        });
        // if (!empty($date_accommodation_details['start_at']) && !empty($end_at)) {
        //     $builder->when($date_accommodation_details, function ($query, $date_accommodation_details) {
        //         return $query->whereBetween('arrival_at', [$date_accommodation_details['start_at'], $date_accommodation_details['end_at']]);
        //     });
        // }
        if (!empty($date_accommodation_details['start_at']) && !empty($end_at)) {
            $builder->when($date_accommodation_details, function ($query, $value) {
                return $query->whereBetween('arrival_at', [$value['start_at'], $value['end_at']]);
            });
        } else {
            $builder->when($options['start_at'], function ($builder, $value) {
                $builder->where('arrival_at', '>=', $value);
            });
            $builder->when($end_at, function ($builder, $value) {
                $value = "$value 23:59:59";
                $builder->where('arrival_at', '<=', $value);
            });
        }
        $builder->when($options['firearm_serial_number'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('firearms')
                    ->whereRaw("firearms.id = accommodation_details.firearm_id AND firearms.firearm_serial_number = ?", [$value]);
            });
        });
        $builder->when($options['license_number'], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->from('firearms')
                    ->whereRaw("firearms.id = accommodation_details.firearm_id AND firearms.license_number = ?", [$value]);
            });
        });
    }
}
