<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Question;
use App\Models\GameSession;
use App\Models\Score;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Show games index (dashboard for students) - ONLY TEACHER GAMES
     */
    public function index()
    {
        if (!session('student_id')) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu');
        }

        $student = \App\Models\Student::find(session('student_id'));
        
        // HANYA game yang dibuat GURU (teacher_id NOT NULL)
        $games = Game::where('is_active', true)
            ->whereNotNull('teacher_id') // Filter: hanya game guru
            ->where('class', $student->kelas) // HANYA game untuk kelas siswa ini
            ->orderBy('order', 'asc')
            ->get();

        return view('game.index', compact('games', 'student'));
    }

    /**
     * Show all games - ONLY SPECIAL/ADMIN GAMES
     */
    public function all()
    {
        if (!session('student_id')) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu');
        }

        $student = \App\Models\Student::find(session('student_id'));

        // HANYA game yang dibuat ADMIN (teacher_id IS NULL)
        // Game spesial untuk SEMUA siswa (tidak dibatasi kelas)
        $games = Game::where('is_active', true)
            ->whereNull('teacher_id') // Filter: hanya game admin/spesial
            ->orderBy('order', 'asc')
            ->get();

        return view('game.all', compact('games', 'student'));
    }

    /**
     * Show history page
     */
    public function history()
    {
        if (!session('student_id')) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu');
        }

        $history_sessions = GameSession::where('student_id', session('student_id'))
            ->with(['game'])
            ->whereNotNull('completed_at')
            ->latest()
            ->get();

        // Calculate Stats
        $total_games = $history_sessions->count();
        $total_score = $history_sessions->sum('total_score');
        $highest_score = $history_sessions->max('total_score') ?? 0;
        
        // Split Scores: Weekly Games (Bahasa Indonesia) vs Teacher Games
        $weekly_game_score = $history_sessions->filter(function ($session) {
            return $session->game && $session->game->category === 'Bahasa Indonesia';
        })->sum('total_score');

        $teacher_game_score = $history_sessions->filter(function ($session) {
            return $session->game && $session->game->category !== 'Bahasa Indonesia';
        })->sum('total_score');

        // Split Sessions for Display
        $weekly_sessions = $history_sessions->filter(function ($session) {
            return $session->game && $session->game->category === 'Bahasa Indonesia';
        });

        $teacher_sessions = $history_sessions->filter(function ($session) {
            return $session->game && $session->game->category !== 'Bahasa Indonesia';
        });

        // Average Score
        $average_score = $total_games > 0 ? round($history_sessions->avg('total_score')) : 0;

        return view('game.history', compact(
            'history_sessions', 
            'total_games', 
            'total_score', 
            'highest_score', 
            'average_score', 
            'weekly_game_score', 
            'teacher_game_score',
            'weekly_sessions',
            'teacher_sessions'
        ));
    }

    /**
     * Show specific game detail
     */
    public function show($slug)
    {
        if (!session('student_id')) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu');
        }

        $game = Game::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $questionsCount = $game->activeQuestions()->count();

        return view('game.detail', compact('game', 'questionsCount'));
    }

    /**
     * Start a new game session
     */
    public function start($slug)
    {
        if (!session('student_id')) {
            // Simpan slug game yang dituju untuk redirect setelah login
            session(['intended_game_slug' => $slug]);
            return redirect()->route('home')->with('show_login', true)->with('error', 'Silakan login terlebih dahulu untuk bermain!');
        }

        $game = Game::where('slug', $slug)->where('is_active', true)->firstOrFail();

        // Create new game session
        $session = GameSession::create([
            'student_id' => session('student_id'),
            'game_id' => $game->id,
            'started_at' => now(),
            'total_questions' => 0,
            'correct_answers' => 0,
            'total_score' => 0
        ]);

        return redirect()->route('games.question', $session->id);
    }

    /**
     * Get and display question for current session
     */
    public function getQuestion($sessionId)
    {
        if (!session('student_id')) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu');
        }

        $session = GameSession::with(['game.template'])->findOrFail($sessionId);

        // Check if session belongs to current student
        if ($session->student_id != session('student_id')) {
            abort(403, 'Unauthorized');
        }

        // Legacy full-page template (stored as raw HTML)
        if ($session->game->custom_template_enabled && filled($session->game->custom_template)) {
            return view('game.custom', compact('session'));
        }

        // Get random question that hasn't been answered in this session
        $answeredQuestionIds = Score::where('game_session_id', $sessionId)
            ->pluck('question_id')
            ->toArray();

        $question = Question::where('game_id', $session->game_id)
            ->where('is_active', true)
            ->whereNotIn('id', $answeredQuestionIds)
            ->inRandomOrder()
            ->first();

        // If no more questions, finish the game
        if (!$question) {
            return redirect()->route('games.finish', $sessionId);
        }

        return view('game.play', compact('session', 'question'));
    }

    /**
     * Submit answer for a question
     */
    public function submitAnswer(Request $request, $sessionId)
    {
        if (!session('student_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $session = GameSession::findOrFail($sessionId);

        if ($session->student_id != session('student_id')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $question = Question::findOrFail($request->question_id);
        $answer = $request->answer;

        // Check if answer is correct
        $isCorrect = $question->checkAnswer($answer);
        $pointsEarned = $isCorrect ? $question->points : 0;

        // Save score
        Score::create([
            'student_id' => session('student_id'),
            'game_session_id' => $sessionId,
            'question_id' => $question->id,
            'answer' => $answer,
            'is_correct' => $isCorrect,
            'points_earned' => $pointsEarned
        ]);

        // Update session stats
        $session->increment('total_questions');
        if ($isCorrect) {
            $session->increment('correct_answers');
        }
        $session->increment('total_score', $pointsEarned);

        $question->loadMissing('game.template');
        $templateType = $question->game?->template?->template_type;

        $correctAnswerForUser = $question->correct_answer;
        if (is_string($correctAnswerForUser)) {
            $decodedCorrect = json_decode($correctAnswerForUser, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedCorrect)) {
                if (is_array($question->options)) {
                    $correctAnswerForUser = collect($decodedCorrect)
                        ->map(fn ($key) => $question->options[$key] ?? $key)
                        ->implode(' → ');
                } else {
                    $correctAnswerForUser = collect($decodedCorrect)->implode(' → ');
                }
            } elseif (is_array($question->options) && array_key_exists($correctAnswerForUser, $question->options)) {
                $correctAnswerForUser = $question->options[$correctAnswerForUser];
            } elseif ($templateType === 'labeled_diagram' && trim($correctAnswerForUser) !== '') {
                $correctAnswerForUser = 'Titik ' . $correctAnswerForUser;
            }
        }

        return response()->json([
            'correct' => $isCorrect,
            'points' => $pointsEarned,
            'correct_answer' => $correctAnswerForUser
        ]);
    }

    /**
     * Finish game session and show results
     */
    public function finish($sessionId)
    {
        if (!session('student_id')) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu');
        }

        $session = GameSession::with('game')->findOrFail($sessionId);

        if ($session->student_id != session('student_id')) {
            abort(403, 'Unauthorized');
        }

        // Mark session as completed
        if (!$session->completed_at) {
            $session->update(['completed_at' => now()]);
        }

        return view('game.result', compact('session'));
    }

    /**
     * Retry the same game
     */
    public function retry($sessionId)
    {
        if (!session('student_id')) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu');
        }

        $session = GameSession::findOrFail($sessionId);

        if ($session->student_id != session('student_id')) {
            abort(403, 'Unauthorized');
        }

        // Start new session for the same game
        return redirect()->route('games.start', $session->game->slug);
    }
}
