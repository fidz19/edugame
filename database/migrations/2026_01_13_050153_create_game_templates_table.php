<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Mencari Kata", "Kuis Gameshow"
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('template_type'); // word_search, quiz, crossword, etc.
            $table->string('icon')->nullable(); // Emoji atau icon name
            $table->json('config_schema')->nullable(); // JSON schema untuk konfigurasi
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable(); // Admin user ID
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_templates');
    }
};
