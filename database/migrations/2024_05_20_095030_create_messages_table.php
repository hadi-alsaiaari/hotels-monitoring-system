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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')
                ->constrained('conversations')
                ->cascadeOnDelete();
            $table->foreignId('messaging_account_id')
                ->nullable()
                ->constrained('messaging_accounts')
                ->nullOnDelete();
            $table->text('body');
            $table->enum('type', ['text', 'attachment'])
                ->default('text');
            $table->bigInteger('sender_id');
            $table->string('sender_name');
            $table->enum('type_message', ['alert', 'chat'])->default('chat');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
