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
        Schema::create('wanted_people', function (Blueprint $table) {
            $table->id();
            $table->morphs('policable');
            $table->string('identity_number', 100);
            $table->string('first_name', 50);
            $table->string('second_name', 50);
            $table->string('third_name', 50);
            $table->string('last_name', 50);
            $table->boolean('is_detection')->default(false);
            $table->timestamp('sure_at')->nullable();
            $table->softDeletes()->nullable();
            $table->timestamps();

            $table->unique(['policable_type', 'identity_number', 'sure_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wanted_people');
    }
};
