<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'question_text',
        'question_data',
        'correct_answer',
        'options',
        'points',
        'difficulty',
        'is_active',
        'image'
    ];

    protected $casts = [
        'question_data' => 'array',
        'options' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke game
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Relasi ke scores
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    /**
     * Check if answer is correct
     */
    public function checkAnswer($answer)
    {
        $correct = $this->correct_answer;

        if (is_string($correct) && is_string($answer)) {
            $decodedCorrect = json_decode($correct, true);
            $decodedAnswer = json_decode($answer, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedCorrect) && is_array($decodedAnswer)) {
                $normalize = static fn ($value) => strtoupper(trim((string) $value));
                $decodedCorrect = array_map($normalize, $decodedCorrect);
                $decodedAnswer = array_map($normalize, $decodedAnswer);

                return $decodedCorrect === $decodedAnswer;
            }
        }

        return strtolower(trim($answer)) === strtolower(trim($this->correct_answer));
    }
}
