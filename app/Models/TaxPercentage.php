<?php

namespace App\Models;

use App\Services\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxPercentage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class', 'percentage', 'decision', 'implementation_date', 'expiry_date', 'status',
    ];
    
    public static function createComingPercentage($request){
        $decision = UploadFile::newUploadFile($request, 'decision');
        $tax_percentage = TaxPercentage::create([
            'class' => $request->class,
            'percentage' => $request->percentage,
            'decision' => $decision,
            'implementation_date' => $request->implementation_date,
            'status' => 'coming',
        ]);
        return $tax_percentage;
    }
    // public static function createPreparatedPercentage($request){
    //     $decision = UploadFile::newUploadFile($request, 'decision');
    //     TaxPercentage::create([
    //         'class' => $request->class,
    //         'percentage' => $request->percentage,
    //         'decision' => $decision,
    //         'implementation_date' => $request->implementation_date,
    //         'status' => 'preparated',
    //     ]);
    // }

    public static function updateUsedPercentage($tax_percentage_used, $expiry_date){
        $expir_date = $expiry_date->subDay();
        $tax_percentage_used->update([
            'expiry_date' => $expir_date,
        ]);
    }

    public function monthly_taxes()
    {
        return $this->hasMany(MonthlyTax::class);
    }
}
