<?php

namespace App\Models;

use App\Traits\HasIdentity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory, HasIdentity;


    // public function identity(){
    //     return $this->morphOne('App\Models\Identity', 'person');
    // }

    public function residential_permits()
    {
        return $this->belongsToMany(ResidentialPermit::class, 'permit_seekers')
            ->withPivot([
                'notice'
            ]);
    }

    public static function createOrGetGuest($guest){
        $identity = Identity::where('identity_number', $guest['identityNumber'])->where('person_type', 'App\Models\Guest')->first();
        
        if($identity){
            $existguest = Guest::findOrFail($identity['person_id']);
        } else{
            $existguest = Guest::create();
            $existguest->identity()->create([
                'identity_number' => $guest['identityNumber'],
                'first_name' => $guest['firstName'],
                'second_name' => $guest['secondName'],
                'third_name' => $guest['thirdName'],
                'last_name' => $guest['lastName'],
                'country' => $guest['country'],
                'place_of_birth' => empty($guest['placeOfBirth'])?'':$guest['placeOfBirth'],
                'date_of_birth' => empty($guest['dateOfBirth'])?null:$guest['dateOfBirth'],
                'sex' => $guest['sex'],
                'date_of_issue' => empty($guest['dateOfIssue'])?null:$guest['dateOfIssue'],
                'date_of_expiry' => empty($guest['dateOfExpiry'])?null:$guest['dateOfExpiry'],
                'issuing_authority' => empty($guest['issuingAuthority'])?'':$guest['issuingAuthority'],
                'identity_type' => $guest['identityType'],
            ]);
        }
        return $existguest;
    }
    
    public function accommodations()
    {
        return $this->belongsToMany(Accommodation::class, 'accommodation_details', 'guest_id', 'accommodation_id')
            ->withPivot([
                'id', 'hotel_system_booking_details_id', 'firearm_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
            ]);
    }

    public function firearms()
    {
        return $this->belongsToMany(Firearm::class, 'accommodation_details', 'guest_id', 'firearm_id',)
            ->withPivot([
                'id', 'hotel_system_booking_details_id', 'accommodation_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
            ]);
    }

    public function check_guest()
    {
        return $this->belongsToMany(Accommodation::class, 'accommodation_details', 'guest_id', 'accommodation_id')
        ->withPivot([
            'id', 'hotel_system_booking_details_id', 'firearm_id', 'escort_with', 'arrival_at', 'departure_at', 'created_at', 'updated_at', 'expected_departure_time'
        ])->wherePivotNull('departure_at');
    }
}
