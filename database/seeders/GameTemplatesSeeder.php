<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GameTemplate;

class GameTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load all template files
        $templateFiles = [
            'quiz_gameshow',
            'true_false',
            'random_card',
            'crossword',
            'labeled_diagram',
            'hangman',
            'airplane',
            'whack_a_mole',
            'balloon_pop',
            'image_quiz',
            'flip_tiles',
            'ranking_order',
            'win_or_lose',
            'watch_memorize',
            'word_magnet',
            'flying_fruit',
            'math_generator',
            'pairs_or_no_pairs',
            'quick_sort',
            'spell_word',
            'word_search',
        ];

        foreach ($templateFiles as $file) {
            $templatePath = database_path("seeders/templates/{$file}.php");
            if (file_exists($templatePath)) {
                $template = require $templatePath;
                $record = GameTemplate::updateOrCreate(
                    ['slug' => $template['slug']],
                    $template
                );
                if ($this->command) {
                    $this->command->info("✅ Upserted template: {$record->name}");
                }
            } else {
                if ($this->command) {
                    $this->command->warn("⚠️ Template file not found: {$file}.php");
                }
            }
        }

        if ($this->command) {
            $this->command->info('');
            $this->command->info('🎮 All ' . count($templateFiles) . ' game templates created successfully!');
        }
    }
}
