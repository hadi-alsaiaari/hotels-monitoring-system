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
        Schema::create('hotel_receptionists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels', 'id');
            $table->foreignId('hotel_executive_manager_id')->constrained('hotel_executive_managers', 'id');
            $table->foreignId('messaging_account_id')->nullable()->constrained('messaging_accounts', 'id');
            $table->softDeletes()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_receptionists');
    }
};
