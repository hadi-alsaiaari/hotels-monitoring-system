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
        Schema::create('block_hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_activity_rule_id')
                ->constrained('hotel_activity_rules')
                ->cascadeOnDelete();
            $table->foreignId('hotel_id')
                ->constrained('hotels')
                ->cascadeOnDelete();
            $table->text('body');
            $table->timestamp('unblock_at')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_hotels');
    }
};
