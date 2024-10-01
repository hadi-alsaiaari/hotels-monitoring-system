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
        Schema::create('potentialpeoples', function (Blueprint $table) {
            $table->foreignId('accommodation_details_id')
                ->constrained('accommodation_details')
                ->cascadeOnDelete();
            $table->foreignId('wanted_people_id')
                ->constrained('wanted_people')
                ->cascadeOnDelete();
            $table->timestamp('detection_at')->nullable();
            $table->boolean('is_same')->nullable();

            $table->primary(['wanted_people_id', 'accommodation_details_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potentialpeoples');
    }
};
