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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('number_accommodation');// generate
            $table->string('hotel_system_booking_id');// primary key in hotel system  for table booking
            $table->foreignId('hotel_id')->constrained('hotels', 'id');
            $table->foreignId('room_id')->constrained('rooms', 'id');// entered number of room
            $table->foreignId('hotel_receptionist_id')->constrained('hotel_receptionists', 'id'); // request()
            $table->foreignId('residential_permit_id')->nullable()->constrained('residential_permits', 'id');// entered number_permit
            
            $table->integer('price');// entered
            $table->string('notice')->nullable();// entered
            $table->timestamp('arrival_at');// entered
            $table->timestamp('departure_at')->nullable();// entered by edit
            $table->timestamp('expected_departure_time')->nullable();
            $table->timestamps();// carbon

            $table->unique(['number_accommodation']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
