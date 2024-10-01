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
        Schema::create('permit_seekers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('residential_permit_id')->constrained('residential_permits', 'id');
            $table->foreignId('guest_id')->constrained('guests', 'id');
            $table->string('notice')->nullable();
            $table->timestamps();

            $table->unique(['residential_permit_id', 'guest_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permit_seekers');
    }
};
