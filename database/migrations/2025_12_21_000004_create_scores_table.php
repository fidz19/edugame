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
        if (Schema::hasTable('scores')) {
            return;
        }

        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('game_session_id')->constrained('game_sessions')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->foreignId('level_id')->nullable()->constrained('levels')->onDelete('cascade'); // Keep for backward compatibility
            $table->text('answer')->nullable(); // Jawaban yang diberikan student
            $table->boolean('is_correct')->default(false); // Benar atau salah
            $table->integer('points_earned')->default(0); // Poin yang didapat
            $table->integer('nilai')->nullable(); // Keep for backward compatibility
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
