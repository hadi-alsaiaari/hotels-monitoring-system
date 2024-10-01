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
        Schema::create('tax_percentages', function (Blueprint $table) {
            $table->id();
            $table->enum('class', ['one', 'two', 'three', 'four', 'five']);
            $table->float('percentage');
            $table->string('decision');
            $table->date('implementation_date');
            $table->enum('status', ['coming', 'used', 'old']);
            $table->date('expiry_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_percentages');
    }
};
