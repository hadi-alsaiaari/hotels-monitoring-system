<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WantedPeople extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'identity_number',
        'first_name',
        'second_name',
        'third_name',
        'last_name',
        'is_detection',
        'detection_at',
    ];

    public function policable(): MorphTo
    {
        return $this->morphTo();
    }
    
    // public function identity(){
    //     return $this->morphOne('App\Models\Identity', 'person');
    // }

    public function accommodations_details()
    {
        return $this->belongsToMany(AccommodationDetails::class, 'potentialpeoples', 'wanted_people_id', 'accommodation_details_id')
            ->withPivot([
                'detection_at', 'is_same'
            ]);
    }
    public function accommodations_details_not_same()
    {
        return $this->belongsToMany(AccommodationDetails::class, 'potentialpeoples', 'wanted_people_id', 'accommodation_details_id')
            ->withPivot([
                'detection_at', 'is_same'
            ])->wherePivot('is_same',NULL);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'identity_number' => null,
            'first_name' => null,
            'second_name' => null,
            'third_name' => null,
            'last_name' => null,
            'is_detection' => null,
            'start_at' => null,
            'end_at' => null,
        ], $filters);
        $end_at = $options['end_at'];
        $date_wanted_people['start_at'] = $options['start_at'];
        $date_wanted_people['end_at'] = "$end_at 23:59:59";
        
        $builder->when($options['identity_number'], function($builder, $value) {
            $builder->where('identity_number', $value);
        });

        $builder->when($options['first_name'], function($builder, $value){
            $builder->where('first_name','LIKE', "%{$value}%");
        });
        $builder->when($options['second_name'], function($builder, $value){
            $builder->where('second_name','LIKE', "%{$value}%");
        });
        $builder->when($options['third_name'], function($builder, $value){
            $builder->where('third_name','LIKE', "%{$value}%");
        });
        $builder->when($options['last_name'], function($builder, $value){
            $builder->where('last_name','LIKE', "%{$value}%");
        });

        $builder->when($options['is_detection'], function ($builder, $value) {
            if ($value == 1) {
                $builder->where('is_detection', '=', 1);
            } else {
                $builder->where('is_detection', '<>', 1);
            }
        });

        if (!empty($date_wanted_people['start_at']) && !empty($end_at)) {
            $builder->when($date_wanted_people, function ($query, $value) {
                return $query->whereBetween('sure_at', [$value['start_at'], $value['end_at']]);
            });
        } else {
            $builder->when($options['start_at'], function ($builder, $value) {
                $builder->where('sure_at', '>=', $value);
            });
            $builder->when($end_at, function ($builder, $value) {
                $value = "$value 23:59:59";
                $builder->where('sure_at', '<=', $value);
            });
        }
    }
}
