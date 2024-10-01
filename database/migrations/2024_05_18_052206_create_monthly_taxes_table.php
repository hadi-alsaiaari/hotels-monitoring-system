<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monthly_taxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels', 'id');
            $table->foreignId('tax_percentage_id')->constrained('tax_percentages', 'id');
            $table->float('total_tax_value'); 
            $table->date('year_month');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->string('hotel_tax_report');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_taxes');
    }
};
