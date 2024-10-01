<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\TourismOffice;
use App\Models\TouristPolice;
use App\Models\SecurityDepartmentOffice;

trait HasRoles
{
    public function create_role()
    {
        return $this->morphMany(Role::class, 'institutionability');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasAbility($ability)
    {
        return $this->role()->whereHas('abilities', function ($query) use ($ability) {
            $query->where('ability', $ability)
                ->where('type', '=', 'allow');
        })->exists();
    }
    
    public static function getUsersHaveAbility($user_type, $ability)
    {
        if($user_type == 't-p'){
            $users = TouristPolice::get();
        } elseif ($user_type == 't-o') {
            $users = TourismOffice::get();
        } else {
            $users = SecurityDepartmentOffice::get();
        }
        foreach ($users as $key => $user) {
            if(!$user->can($ability))
            {
                unset($users[$key]);
            } 
        }
        return $users;
    }
}
