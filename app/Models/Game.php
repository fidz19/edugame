<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'html_template',
        'css_style',
        'js_code',
        'custom_template',
        'custom_template_enabled',
        'game_images',
        'category',
        'is_active',
        'order',
        'template_id',
        'teacher_id',
        'template_config',
        'class' // Added class field
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'custom_template_enabled' => 'boolean',
        'template_config' => 'array'
    ];

    /**
     * Relasi ke questions
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Relasi ke game sessions
     */
    public function sessions()
    {
        return $this->hasMany(GameSession::class);
    }

    /**
     * Relasi ke template
     */
    public function template()
    {
        return $this->belongsTo(GameTemplate::class, 'template_id');
    }

    /**
     * Relasi ke guru yang membuat game
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    /**
     * Get active questions only
     */
    public function activeQuestions()
    {
        return $this->hasMany(Question::class)->where('is_active', true);
    }
}
