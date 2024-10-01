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
        Schema::create('residential_permits', function (Blueprint $table) {
            $table->id();
            $table->string('number_permit')->unique();
            $table->foreignId('tourist_police_id')->constrained('tourist_police', 'id');
            $table->foreignId('hotel_id')->constrained('hotels', 'id');
            $table->enum('status',['not_use', 'used', 'used_expired', 'not_used_expired'])->default('not_use');
            $table->string('manager_name');
            $table->smallInteger('days_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residential_permits');
    }
};
