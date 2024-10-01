<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'institution_type',
        'institution_id',
    ];

    public function abilities()
    {
        return $this->hasMany(RoleAbility::class);
    }

    public static function createWithAbilities(Request $request,$user)
    {
        DB::beginTransaction();
        try {
            $role = Role::create([
                'institution_type' => get_class($user),
                'institution_id' => $user->id,
                'name' => $request->name,
            ]);

            foreach ($request->abilities as $ability => $value) {
                RoleAbility::create([
                    'role_id' => $role->id,
                    'ability' => $ability,
                    'type' => $value,
                ]);
            }
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $role;
    }

    public function updateWithAbilities(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->update([
                'name' => $request->name,
            ]);

            foreach ($request->abilities as $ability => $value) {
                RoleAbility::updateOrCreate([
                    'role_id' => $this->id,
                    'ability' => $ability,
                ], [
                    'type' => $value,
                ]);
            }
            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $this;
    }

    public function institutionability(): MorphTo
    {
        return $this->morphTo();
    }

    public function tourist_polices()
    {
        return $this->hasMany(TouristPolice::class);
    }
    public function tourism_offices()
    {
        return $this->hasMany(TourismOffice::class);
    }
    public function security_department_ffices()
    {
        return $this->hasMany(SecurityDepartmentOffice::class);
    }
}
