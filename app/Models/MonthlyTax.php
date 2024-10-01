<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyTax extends Model
{
    use HasFactory;

    protected $table = 'monthly_taxes';

    protected $fillable = [
        'hotel_id', 'tax_percentage_id', 'total_tax_value', 'year_month', 'payment_status', 'hotel_tax_report',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function tax_percentage()
    {
        return $this->belongsTo(TaxPercentage::class);
    }
}
