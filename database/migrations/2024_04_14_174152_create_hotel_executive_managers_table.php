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
        Schema::create('hotel_executive_managers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels', 'id');
            $table->foreignId('messaging_account_id')->nullable()->constrained('messaging_accounts', 'id');
            $table->string('education_level', 100);
            $table->date('date_of_work_license')->nullable();
            $table->string('work_license_number', 100);
            $table->string('qualification');
            $table->string('experience_certificate');
            $table->string('identity_photo');
            $table->softDeletes()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_executive_managers');
    }
};
