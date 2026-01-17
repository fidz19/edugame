<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\GameSession;
use App\Models\Game;
use App\Models\GameTemplate;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    /**
     * Generate a unique slug for the game
     */
    private function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        // Check if slug exists (excluding current game when updating)
        while (true) {
            $query = Game::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('teacher.login');
    }

    /**
     * Process login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Find teacher by email
        $teacher = Teacher::where('email', $request->email)->first();

        // Check if teacher exists and password matches
        if ($teacher && Hash::check($request->password, $teacher->password)) {
            session([
                'teacher_id' => $teacher->id,
                'teacher_name' => $teacher->name,
                'teacher_subject' => $teacher->subject
            ]);

            return redirect()->route('teacher.dashboard');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    /**
     * Show teacher dashboard
     */
    public function dashboard(Request $request)
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $teacher = Teacher::with('students')->findOrFail(session('teacher_id'));

        // Get filter class from request
        $filterClass = $request->get('class', null);

        // Get students based on filter
        if ($filterClass) {
            $students = $teacher->students()->where('kelas', $filterClass)->get();
        } else {
            $students = $teacher->students;
        }

        // Calculate statistics
        $totalStudents = $teacher->students->count();
        $totalGamesPlayed = 0;
        $totalScore = 0;
        $totalQuestions = 0;
        $totalCorrect = 0;

        // Get all game sessions for teacher's students
        $studentIds = $teacher->students->pluck('id')->toArray();

        $allSessions = GameSession::with(['game', 'student'])
            ->whereIn('student_id', $studentIds)
            ->whereNotNull('completed_at')
            ->orderBy('completed_at', 'desc')
            ->get();

        $totalGamesPlayed = $allSessions->count();
        $totalScore = $allSessions->sum('total_score');
        $totalQuestions = $allSessions->sum('total_questions');
        $totalCorrect = $allSessions->sum('correct_answers');

        $averageScore = $totalGamesPlayed > 0 ? round($totalScore / $totalGamesPlayed, 2) : 0;
        $overallAccuracy = $totalQuestions > 0 ? round(($totalCorrect / $totalQuestions) * 100, 2) : 0;

        // Get stats per class
        $classStats = [];
        for ($i = 1; $i <= 6; $i++) {
            $classStudents = $teacher->students()->where('kelas', $i)->count();
            $classStats[$i] = $classStudents;
        }

        // Get recent activities (last 10 sessions)
        $recentSessions = $allSessions->take(10);

        // Get top performers (students with highest average score)
        $topPerformers = [];
        foreach ($students as $student) {
            $studentSessions = GameSession::where('student_id', $student->id)
                ->whereNotNull('completed_at')
                ->get();

            if ($studentSessions->count() > 0) {
                $avgScore = $studentSessions->avg('total_score');
                $topPerformers[] = [
                    'student' => $student,
                    'avg_score' => round($avgScore, 2),
                    'games_played' => $studentSessions->count()
                ];
            }
        }

        // Sort top performers by average score
        usort($topPerformers, function ($a, $b) {
            return $b['avg_score'] <=> $a['avg_score'];
        });
        $topPerformers = array_slice($topPerformers, 0, 5);

        // Get today's schedules for this teacher
        $todaySchedules = Schedule::active()
            ->forTeacher($teacher->id)
            ->today()
            ->with('student')
            ->orderBy('start_time')
            ->get();

        // Get total games created by this teacher
        $totalGamesCreated = Game::where('teacher_id', $teacher->id)->count();

        return view('teacher.dashboard', compact(
            'teacher',
            'students',
            'totalStudents',
            'totalGamesPlayed',
            'averageScore',
            'overallAccuracy',
            'classStats',
            'recentSessions',
            'topPerformers',
            'filterClass',
            'todaySchedules',
            'totalGamesCreated'
        ));
    }

    /**
     * Show games created by teacher
     */
    public function games()
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $teacher = Teacher::findOrFail(session('teacher_id'));
        $games = Game::with(['template', 'questions'])
            ->where('teacher_id', $teacher->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('teacher.games.index', compact('games', 'teacher'));
    }

    /**
     * Show create game form
     */
    public function createGame()
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $templates = GameTemplate::active()->get();
        return view('teacher.games.create', compact('templates'));
    }

    /**
     * Store new game
     */
    public function storeGame(Request $request)
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $request->validate([
            'template_id' => 'required|exists:game_templates,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
        ]);

        $game = Game::create([
            'template_id' => $request->template_id,
            'teacher_id' => session('teacher_id'),
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title),
            'description' => $request->description,
            'category' => $request->category,
            'is_active' => true,
            'order' => 0,
        ]);

        return redirect()->route('teacher.games.edit', $game->id)
            ->with('success', 'Game berhasil dibuat! Silakan tambahkan soal.');
    }

    /**
     * Show edit game form
     */
    public function editGame($id)
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $game = Game::with(['template', 'questions'])
            ->where('id', $id)
            ->where('teacher_id', session('teacher_id'))
            ->firstOrFail();

        return view('teacher.games.edit', compact('game'));
    }

    /**
     * Update game
     */
    public function updateGame(Request $request, $id)
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $game = Game::where('id', $id)
            ->where('teacher_id', session('teacher_id'))
            ->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $game->update([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title, $game->id),
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('teacher.games')
            ->with('success', 'Game berhasil diupdate!');
    }

    /**
     * Delete game
     */
    public function deleteGame($id)
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $game = Game::where('id', $id)
            ->where('teacher_id', session('teacher_id'))
            ->firstOrFail();

        $game->delete();

        return redirect()->route('teacher.games')
            ->with('success', 'Game berhasil dihapus!');
    }

    /**
     * Show teacher's teaching schedule
     */
    public function schedules()
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $teacher = Teacher::findOrFail(session('teacher_id'));
        $schedules = Schedule::active()
            ->forTeacher($teacher->id)
            ->with('student')
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return view('teacher.schedules', compact('schedules', 'teacher'));
    }

    /**
     * Get students by class
     */
    public function getStudentsByClass($class)
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        return redirect()->route('teacher.dashboard', ['class' => $class]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->forget(['teacher_id', 'teacher_name', 'teacher_subject']);
        return redirect()->route('teacher.login')->with('success', 'Berhasil logout');
    }

    /**
     * Store a new question for a game
     */
    public function storeQuestion(Request $request, $id)
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $game = Game::with('template')->where('id', $id)
            ->where('teacher_id', session('teacher_id'))
            ->firstOrFail();

        $templateType = $game->template->template_type ?? $request->template_type ?? 'quiz';

        $requiresImageTypes = ['image_quiz', 'labeled_diagram'];
        $requiresFourOptionsTypes = [
            'quiz_gameshow',
            'random_card',
            'balloon_pop',
            'whack_a_mole',
            'flip_tiles',
            'win_or_lose',
            'watch_memorize',
            'flying_fruit',
            'airplane',
            'ranking_order',
            'quick_sort',
            'word_magnet',
            'pairs_or_no_pairs',
        ];

        if (in_array($templateType, $requiresImageTypes, true)) {
            $request->validate([
                'image' => ['required', 'image', 'max:2048'],
            ]);
        } else {
            $request->validate([
                'image' => ['nullable', 'image', 'max:2048'],
            ]);
        }

        // Different validation based on template type
        if (in_array($templateType, ['quiz', 'image_quiz'])) {
            // Multiple choice
            $request->validate([
                'question_text' => 'required|string',
                'option_a' => 'required|string',
                'option_b' => 'required|string',
                'option_c' => 'nullable|string',
                'option_d' => 'nullable|string',
            ]);

            $options = [
                'A' => $request->option_a,
                'B' => $request->option_b,
            ];
            if ($request->option_c) {
                $options['C'] = $request->option_c;
            }
            if ($request->option_d) {
                $options['D'] = $request->option_d;
            }

            $request->validate([
                'correct_answer' => ['required', Rule::in(array_keys($options))],
            ]);

            $correctAnswer = $request->correct_answer;

        } elseif (in_array($templateType, ['ranking_order', 'word_magnet'], true)) {
            $request->validate([
                'question_text' => 'required|string',
                'option_a' => 'required|string',
                'option_b' => 'required|string',
                'option_c' => 'required|string',
                'option_d' => 'required|string',
                'correct_order' => ['required', 'array', 'size:4'],
                'correct_order.*' => ['required', Rule::in(['A', 'B', 'C', 'D'])],
            ]);

            $order = array_map(
                static fn ($value) => strtoupper(trim((string) $value)),
                (array) $request->input('correct_order', [])
            );

            if (count(array_unique($order)) !== 4) {
                return back()
                    ->withErrors(['correct_order' => 'Urutan jawaban harus unik (tidak boleh ada yang sama).'])
                    ->withInput();
            }

            $options = [
                'A' => $request->option_a,
                'B' => $request->option_b,
                'C' => $request->option_c,
                'D' => $request->option_d,
            ];
            $correctAnswer = json_encode(array_values($order));

        } elseif ($templateType == 'true_false') {
            // True or False
            $request->validate([
                'question_text' => 'required|string',
                'correct_answer' => 'required|in:true,false',
            ]);

            $options = [
                'true' => 'Benar',
                'false' => 'Salah',
            ];
            $correctAnswer = $request->correct_answer;

        } elseif ($templateType === 'labeled_diagram') {
            $request->validate([
                'question_text' => 'required|string',
                'correct_answer' => ['required', Rule::in(['1', '2', '3'])],
            ]);

            $options = null;
            $correctAnswer = (string) $request->correct_answer;

        } elseif ($templateType === 'crossword') {
            $request->validate([
                'question_text' => 'required|string',
                'correct_answer' => 'required|string',
            ]);

            $options = null;
            $correctAnswer = strtoupper(trim((string) $request->correct_answer));

        } elseif (in_array($templateType, ['hangman', 'word_search', 'spell_word'], true)) {
            // Word-based games - require a correct word (answer)
            $request->validate([
                'question_text' => 'required|string',
                'correct_answer' => 'required|string',
            ]);

            $options = null;
            $correctAnswer = strtoupper(trim((string) $request->correct_answer));

        } elseif (in_array($templateType, ['type_answer', 'math_generator'], true)) {
            // Text answer
            $request->validate([
                'question_text' => 'required|string',
                'correct_answer' => 'required|string',
            ]);

            $options = null;
            $correctAnswer = trim((string) $request->correct_answer);

        } else {
            // Default: multiple choice
            $needsFour = in_array($templateType, $requiresFourOptionsTypes, true);

            $request->validate(array_merge(
                [
                    'question_text' => 'required|string',
                    'option_a' => 'required|string',
                    'option_b' => 'required|string',
                ],
                $needsFour
                    ? ['option_c' => 'required|string', 'option_d' => 'required|string']
                    : ['option_c' => 'nullable|string', 'option_d' => 'nullable|string']
            ));

            $options = [
                'A' => $request->option_a,
                'B' => $request->option_b,
            ];
            if ($needsFour || $request->option_c) {
                $options['C'] = $request->option_c;
            }
            if ($needsFour || $request->option_d) {
                $options['D'] = $request->option_d;
            }

            $request->validate([
                'correct_answer' => ['required', Rule::in(array_keys($options))],
            ]);
            $correctAnswer = $request->correct_answer;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->putFile('questions/images', $request->file('image'));
        }

        \App\Models\Question::create([
            'game_id' => $game->id,
            'question_text' => $request->question_text,
            'options' => $options,
            'correct_answer' => $correctAnswer,
            'is_active' => true,
            'points' => 10,
            'image' => $imagePath,
        ]);

        return redirect()->route('teacher.games.edit', $game->id)
            ->with('success', 'Soal berhasil ditambahkan!');
    }

    /**
     * Update a question
     */
    public function updateQuestion(Request $request, $id, $questionId)
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $game = Game::with('template')->where('id', $id)
            ->where('teacher_id', session('teacher_id'))
            ->firstOrFail();

        $question = \App\Models\Question::where('id', $questionId)
            ->where('game_id', $game->id)
            ->firstOrFail();

        $templateType = $game->template->template_type ?? $request->template_type ?? 'quiz';

        $requiresImageTypes = ['image_quiz', 'labeled_diagram'];
        $requiresFourOptionsTypes = [
            'quiz_gameshow',
            'random_card',
            'balloon_pop',
            'whack_a_mole',
            'flip_tiles',
            'win_or_lose',
            'watch_memorize',
            'flying_fruit',
            'airplane',
            'ranking_order',
            'quick_sort',
            'word_magnet',
            'pairs_or_no_pairs',
        ];

        if (in_array($templateType, $requiresImageTypes, true)) {
            $request->validate([
                'image' => ['nullable', 'image', 'max:2048'],
            ]);
        } else {
            $request->validate([
                'image' => ['nullable', 'image', 'max:2048'],
            ]);
        }

        if ($templateType === 'true_false') {
            $request->validate([
                'question_text' => 'required|string',
                'correct_answer' => 'required|in:true,false',
            ]);

            $options = [
                'true' => 'Benar',
                'false' => 'Salah',
            ];
            $correctAnswer = $request->correct_answer;
        } elseif (in_array($templateType, ['ranking_order', 'word_magnet'], true)) {
            $request->validate([
                'question_text' => 'required|string',
                'option_a' => 'required|string',
                'option_b' => 'required|string',
                'option_c' => 'required|string',
                'option_d' => 'required|string',
                'correct_order' => ['required', 'array', 'size:4'],
                'correct_order.*' => ['required', Rule::in(['A', 'B', 'C', 'D'])],
            ]);

            $order = array_map(
                static fn ($value) => strtoupper(trim((string) $value)),
                (array) $request->input('correct_order', [])
            );

            if (count(array_unique($order)) !== 4) {
                return back()
                    ->withErrors(['correct_order' => 'Urutan jawaban harus unik (tidak boleh ada yang sama).'])
                    ->withInput();
            }

            $options = [
                'A' => $request->option_a,
                'B' => $request->option_b,
                'C' => $request->option_c,
                'D' => $request->option_d,
            ];
            $correctAnswer = json_encode(array_values($order));
        } elseif ($templateType === 'labeled_diagram') {
            $request->validate([
                'question_text' => 'required|string',
                'correct_answer' => ['required', Rule::in(['1', '2', '3'])],
            ]);

            $options = null;
            $correctAnswer = (string) $request->correct_answer;
        } elseif ($templateType === 'crossword') {
            $request->validate([
                'question_text' => 'required|string',
                'correct_answer' => 'required|string',
            ]);

            $options = null;
            $correctAnswer = strtoupper(trim((string) $request->correct_answer));
        } elseif (in_array($templateType, ['hangman', 'word_search', 'spell_word'], true)) {
            $request->validate([
                'question_text' => 'required|string',
                'correct_answer' => 'required|string',
            ]);

            $options = null;
            $correctAnswer = strtoupper(trim((string) $request->correct_answer));
        } elseif (in_array($templateType, ['type_answer', 'math_generator'], true)) {
            $request->validate([
                'question_text' => 'required|string',
                'correct_answer' => 'required|string',
            ]);

            $options = null;
            $correctAnswer = trim((string) $request->correct_answer);
        } else {
            $needsFour = in_array($templateType, $requiresFourOptionsTypes, true);

            $request->validate(array_merge(
                [
                    'question_text' => 'required|string',
                    'option_a' => 'required|string',
                    'option_b' => 'required|string',
                ],
                $needsFour
                    ? ['option_c' => 'required|string', 'option_d' => 'required|string']
                    : ['option_c' => 'nullable|string', 'option_d' => 'nullable|string']
            ));

            $options = [
                'A' => $request->option_a,
                'B' => $request->option_b,
            ];
            if ($needsFour || $request->option_c) {
                $options['C'] = $request->option_c;
            }
            if ($needsFour || $request->option_d) {
                $options['D'] = $request->option_d;
            }

            $request->validate([
                'correct_answer' => ['required', Rule::in(array_keys($options))],
            ]);
            $correctAnswer = $request->correct_answer;
        }

        $imagePath = $question->image;
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->putFile('questions/images', $request->file('image'));
        }

        $question->update([
            'question_text' => $request->question_text,
            'options' => $options,
            'correct_answer' => $correctAnswer,
            'image' => $imagePath,
        ]);

        return redirect()->route('teacher.games.edit', $game->id)
            ->with('success', 'Soal berhasil diupdate!');
    }

    /**
     * Delete a question
     */
    public function deleteQuestion($id, $questionId)
    {
        if (!session('teacher_id')) {
            return redirect()->route('teacher.login');
        }

        $game = Game::where('id', $id)
            ->where('teacher_id', session('teacher_id'))
            ->firstOrFail();

        $question = \App\Models\Question::where('id', $questionId)
            ->where('game_id', $game->id)
            ->firstOrFail();

        $question->delete();

        return redirect()->route('teacher.games.edit', $game->id)
            ->with('success', 'Soal berhasil dihapus!');
    }
}
