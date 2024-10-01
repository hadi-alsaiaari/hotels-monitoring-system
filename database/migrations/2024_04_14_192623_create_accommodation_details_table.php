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
        Schema::create('accommodation_details', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_system_booking_details_id');// primary key in hotel system  for table booking details
            $table->foreignId('accommodation_id')->constrained('accommodations', 'id');
            $table->foreignId('guest_id')->constrained('guests', 'id');
            $table->foreignId('firearm_id')->nullable()->constrained('firearms', 'id');
            $table->foreignId('escort_with')->nullable()->constrained('accommodation_details', 'id');// the first guest is the owner of accommodation
            $table->timestamp('arrival_at');// the same arrival_at of accommodation in create
            $table->timestamp('departure_at')->nullable();
            $table->timestamp('expected_departure_time')->nullable();
            $table->timestamps();

            $table->unique(['accommodation_id', 'guest_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodation_details');
    }
};
