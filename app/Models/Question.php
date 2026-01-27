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
     * Get the options attribute
     * Ensure it's always an array with string keys and values
     */
    public function getOptionsAttribute($value)
    {
        if (is_null($value)) {
            return [];
        }

        $decoded = json_decode($value, true);
        
        if (!is_array($decoded)) {
            return [];
        }

        // Ensure all keys and values are strings
        $result = [];
        foreach ($decoded as $key => $val) {
            $result[(string)$key] = (string)$val;
        }

        return $result;
    }

    /**
     * Set the options attribute
     * Ensure it's stored as JSON with string keys and values
     */
    public function setOptionsAttribute($value)
    {
        if (is_null($value) || empty($value)) {
            $this->attributes['options'] = null;
            return;
        }

        if (is_array($value)) {
            // Ensure all keys and values are strings
            $result = [];
            foreach ($value as $key => $val) {
                $result[(string)$key] = (string)$val;
            }
            $this->attributes['options'] = json_encode($result);
        } else {
            $this->attributes['options'] = $value;
        }
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
