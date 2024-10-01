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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_owner_id')->constrained('hotel_owners', 'id');
            $table->string('hotel_email')->unique();
            $table->string('trade_name')->unique();
            $table->string('name_owner_building');
            $table->enum('situation', ['branch', 'main_center']);
            $table->string('website')->unique()->nullable();
            $table->string('hotel_governorate')->default('Hadhramout');
            $table->string('hotel_directoration');
            $table->string('hotel_city');
            $table->string('hotel_street_address');
            $table->string('fax')->nullable();
            $table->enum('class', ['one', 'two', 'three', 'four', 'five'])->nullable();
            $table->string('operator_management', 100)->nullable();
            $table->unsignedSmallInteger('number_of_employees');
            $table->unsignedSmallInteger('yemeni_employee');
            $table->string('commercial_record');
            $table->string('building_property');
            $table->string('personal_card');
            $table->enum('status', ['active', 'inactive', 'block'])->default('inactive');
            $table->enum('license', ['request', 'request2', 'processing', 'preparation', 'preparation2', 'valid', 'renewal', 'rejected'])->default('request');
            $table->softDeletes()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
