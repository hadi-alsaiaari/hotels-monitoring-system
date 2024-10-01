<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

class Identity extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'identity_number',
        'first_name',
        'second_name',
        'third_name',
        'last_name',
        'country',
        'place_of_birth',
        'date_of_birth',
        'sex',
        'date_of_issue',
        'date_of_expiry',
        'issuing_authority',
        'identity_type',
    ];
    
    public function person(): MorphTo
    {
        return $this->morphTo();
    }

    protected $appends = [
        'full_name',
        // 'country_name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'datetime',
        'date_of_issue' => 'datetime',
        'date_of_expiry' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->second_name . ' ' . $this->third_name . ' ' . $this->last_name;
    }
    // public function getCountryNameAttribute()
    // {
    //     return Countries::getName($this->country);
    // }

    public static function checkEmployeeIdentity($date_of_birth, $date_of_issue, $date_of_expiry)
    {
        if ($date_of_issue > now()) {
            return 0;
        }
        $date_of_issue = now()->setDateFrom($date_of_issue)->addRealYear();
        if ($date_of_issue > $date_of_expiry) {
            return 0;
        }
        if ($date_of_birth > now()->subRealYears(25)) {
            return 0;
        }
        return 1;
    }

    public static function checkGuestIdentity($date_of_birth, $date_of_issue, $date_of_expiry)
    {
        if ($date_of_issue > now()) {
            return 0;
        }
        $date_of_issue = now()->setDateFrom($date_of_issue)->addRealYear();
        if ($date_of_issue > $date_of_expiry) {
            return 0;
        }
        if ($date_of_birth > now()->subRealYears(18)) {
            return 0;
        }
        return 1;
    }

    // public static function rules($id = 0)
    // {
    //     return [
    //         'identity_number' => ['required', 'string', 'min:9', 'max:255',
    //             // Rule::unique('identities', 'identity_number')->ignore($id),
    //             Rule::unique(Identity::class),
    //         ],
    //         'first_name' => ['required', 'string', 'min:3', 'max:30'],
    //         'second_name' => ['required', 'string', 'min:3', 'max:30'],
    //         'third_name' => ['required', 'string', 'min:3', 'max:30'],
    //         'last_name' => ['required', 'string', 'min:3', 'max:30'],
    //         'date_of_expiry' => ['required', 'date'],
    //         'sex' => 'required|in:male,female',
    //     ];
    // }
}
