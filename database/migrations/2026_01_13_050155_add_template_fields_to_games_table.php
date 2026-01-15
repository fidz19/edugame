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
        Schema::table('games', function (Blueprint $table) {
            $table->unsignedBigInteger('template_id')->nullable()->after('id');
            $table->unsignedBigInteger('teacher_id')->nullable()->after('template_id');
            $table->json('template_config')->nullable()->after('custom_template');

            $table->foreign('template_id')->references('id')->on('game_templates')->onDelete('set null');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign(['template_id']);
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['template_id', 'teacher_id', 'template_config']);
        });
    }
};
