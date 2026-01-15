<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'template_type',
        'icon',
        'html_template',
        'css_style',
        'js_code',
        'preview_image',
        'config_schema',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'config_schema' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Relasi: Template punya banyak game
     */
    public function games()
    {
        return $this->hasMany(Game::class, 'template_id');
    }

    /**
     * Relasi: Template dibuat oleh admin (User)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get available template types
     */
    public static function getAvailableTypes()
    {
        return [
            'word_search' => 'Mencari Kata',
            'quiz_gameshow' => 'Kuis Gameshow',
            'random_card' => 'Kartu Acak',
            'crossword' => 'Teka Teki Silang',
            'labeled_diagram' => 'Diagram Berlabel',
            'true_false' => 'Benar atau Salah',
            'hangman' => 'Si Algojo',
            'airplane' => 'Pesawat Terbang',
            'whack_a_mole' => 'Whack-a-mole (Memukul Tikus Mondok)',
            'balloon_pop' => 'Pecah Balon',
            'image_quiz' => 'Kuis Gambar',
            'flip_tiles' => 'Balik Ubin',
            'ranking_order' => 'Urutan Peringkat',
            'win_or_lose' => 'Kuis Menang atau Kalah',
            'watch_memorize' => 'Tonton dan Hafalkan',
            'word_magnet' => 'Magnet Kata',
            'flying_fruit' => 'Buah Terbang',
            'math_generator' => 'Generator Matematika',
            'pairs_or_no_pairs' => 'Pasangan atau Tanpa Pasangan',
            'quick_sort' => 'Penyortiran Cepat',
            'spell_word' => 'Mengeja Kata'
        ];
    }

    /**
     * Scope untuk template aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
