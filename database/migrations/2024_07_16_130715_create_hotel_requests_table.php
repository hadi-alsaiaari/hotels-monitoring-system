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
        Schema::create('hotel_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')
                ->constrained('hotels')
                ->cascadeOnDelete();
            $table->string('field_landing_report')->nullable();
            $table->timestamp('field_landing_at')->nullable();
            $table->string('account')->nullable();
            $table->integer('money')->nullable();
            $table->string('bank')->nullable();
            $table->string('class')->nullable();
            $table->string('transfer_deed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_requests');
    }
};
