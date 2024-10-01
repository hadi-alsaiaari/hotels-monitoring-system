<?php

namespace App\Models;

use App\Traits\HasIdentity;
use App\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class TouristPolice extends User implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable, SoftDeletes, HasIdentity, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'status', 'super_tourist_police', 'messaging_account_id', 'deleted_at', 'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wanted_peoples(): MorphMany
    {
        return $this->morphMany('App\Models\WantedPeople', 'policable');
    }

    public function residential_permits()
    {
        return $this->hasMany(ResidentialPermit::class, 'tourist_police_id', 'id');
    }
}
