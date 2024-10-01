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
        Schema::create('identities', function (Blueprint $table) {
            $table->id();
            $table->morphs('person');
            $table->string('identity_number', 100);
            $table->string('first_name', 50);
            $table->string('second_name', 50);
            $table->string('third_name', 50);
            $table->string('last_name', 50);
            $table->char('country', 2);
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('sex', ['male', 'female']);
            $table->date('date_of_issue')->nullable();
            $table->date('date_of_expiry')->nullable();
            $table->string('issuing_authority', 100)->nullable();
            $table->string('identity_type', 100);

            $table->unique(['person_type', 'identity_number']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identities');
    }
};
