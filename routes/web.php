<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\GameController;
use App\Http\Middleware\CheckStudentLogin;
use App\Http\Middleware\CheckParentLogin;

// Route home
Route::get('/', function () {
    return view('home');
})->name('home');

// ==================== ADMIN ROUTES ====================
// Admin panel sekarang menggunakan Filament
// Akses di: /admin (handled by Filament)


// ==================== STUDENT ROUTES ====================
// Route login student
Route::post('/student/login', [StudentController::class, 'login'])->name('student.login');
Route::get('/student/logout', [StudentController::class, 'logout'])->name('student.logout');

// Route start game - bisa diakses sebelum login (akan redirect ke home jika belum login)
Route::match(['get', 'post'], '/games/{slug}/start', [GameController::class, 'start'])->name('games.start');

// Route games - HARUS LOGIN DULU
Route::middleware(['CheckStudentLogin'])->group(function () {
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::get('/games/all', [GameController::class, 'all'])->name('games.all');
    Route::get('/games/history', [GameController::class, 'history'])->name('games.history'); // New History Route
    Route::get('/games/{slug}', [GameController::class, 'show'])->name('games.show');
    Route::get('/session/{id}/question', [GameController::class, 'getQuestion'])->name('games.question');
    Route::post('/session/{id}/answer', [GameController::class, 'submitAnswer'])->name('games.answer');
    Route::get('/session/{id}/finish', [GameController::class, 'finish'])->name('games.finish');
    Route::post('/session/{id}/retry', [GameController::class, 'retry'])->name('games.retry');
});

// ==================== PARENT ROUTES ====================
Route::get('/parent/login', [ParentController::class, 'showLoginForm'])->name('parent.login');
Route::post('/parent/login', [ParentController::class, 'login'])->name('parent.login.post');
Route::get('/parent/register', [ParentController::class, 'showRegisterForm'])->name('parent.register');
Route::post('/parent/register', [ParentController::class, 'register'])->name('parent.register.post');

Route::middleware(['CheckParentLogin'])->group(function () {
    Route::get('/parent/dashboard', [ParentController::class, 'dashboard'])->name('parent.dashboard');
    Route::get('/parent/jadwal', [ParentController::class, 'jadwal'])->name('parent.jadwal');
    Route::get('/parent/logout', [ParentController::class, 'logout'])->name('parent.logout');
});

// ==================== TEACHER ROUTES ====================
Route::get('/teacher/login', [App\Http\Controllers\TeacherController::class, 'showLoginForm'])->name('teacher.login');
Route::post('/teacher/login', [App\Http\Controllers\TeacherController::class, 'login'])->name('teacher.login.post');

Route::middleware(['CheckTeacherLogin'])->group(function () {
    Route::get('/teacher/dashboard', [App\Http\Controllers\TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/classes', [App\Http\Controllers\TeacherController::class, 'classes'])->name('teacher.classes');
    Route::get('/teacher/students/{class}', [App\Http\Controllers\TeacherController::class, 'getStudentsByClass'])->name('teacher.students.class');
    Route::get('/teacher/logout', [App\Http\Controllers\TeacherController::class, 'logout'])->name('teacher.logout');

    // Teacher Games Management
    Route::get('/teacher/games', [App\Http\Controllers\TeacherController::class, 'games'])->name('teacher.games');
    Route::get('/teacher/games/create', [App\Http\Controllers\TeacherController::class, 'createGame'])->name('teacher.games.create');
    Route::post('/teacher/games', [App\Http\Controllers\TeacherController::class, 'storeGame'])->name('teacher.games.store');
    Route::get('/teacher/games/{id}/edit', [App\Http\Controllers\TeacherController::class, 'editGame'])->name('teacher.games.edit');
    Route::put('/teacher/games/{id}', [App\Http\Controllers\TeacherController::class, 'updateGame'])->name('teacher.games.update');
    Route::delete('/teacher/games/{id}', [App\Http\Controllers\TeacherController::class, 'deleteGame'])->name('teacher.games.delete');

    // Teacher Questions Management (for games)
    Route::post('/teacher/games/{id}/questions', [App\Http\Controllers\TeacherController::class, 'storeQuestion'])->name('teacher.games.questions.store');
    Route::put('/teacher/games/{id}/questions/{questionId}', [App\Http\Controllers\TeacherController::class, 'updateQuestion'])->name('teacher.games.questions.update');
    Route::delete('/teacher/games/{id}/questions/{questionId}', [App\Http\Controllers\TeacherController::class, 'deleteQuestion'])->name('teacher.games.questions.delete');

    // Teacher Schedules (View Only - Created by Admin)
    Route::get('/teacher/schedules', [App\Http\Controllers\TeacherController::class, 'schedules'])->name('teacher.schedules');
});

// ==================== PUBLIC POSTER ROUTE ====================
Route::get('/posters', [App\Http\Controllers\PosterController::class, 'index'])->name('posters.index');
