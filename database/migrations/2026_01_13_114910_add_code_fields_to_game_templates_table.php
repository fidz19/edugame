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
        Schema::table('game_templates', function (Blueprint $table) {
            $table->longText('html_template')->nullable()->after('description');
            $table->longText('css_style')->nullable()->after('html_template');
            $table->longText('js_code')->nullable()->after('css_style');
            $table->string('preview_image')->nullable()->after('js_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_templates', function (Blueprint $table) {
            $table->dropColumn(['html_template', 'css_style', 'js_code', 'preview_image']);
        });
    }
};
