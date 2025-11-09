<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\ExerciseController as AdminExerciseController;
use App\Http\Controllers\Admin\SimulatorController as AdminSimulatorController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SimulatorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Lessons
Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
Route::get('/lesson/{id}', [LessonController::class, 'show'])->name('lessons.show');
Route::post('/lesson/{id}/complete', [LessonController::class, 'markCompleted'])->name('lessons.complete');

// Exercises
Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises.index');
Route::get('/exercise/{id}', [ExerciseController::class, 'show'])->name('exercises.show');
Route::post('/exercise/{id}/submit', [ExerciseController::class, 'submit'])->name('exercises.submit');

// Simulators
Route::get('/simulators', [SimulatorController::class, 'index'])->name('simulators.index');
Route::get('/simulator/{id}', [SimulatorController::class, 'show'])->name('simulators.show');
Route::post('/simulator/{id}/evaluate', [SimulatorController::class, 'evaluate'])->name('simulators.evaluate');

// Quizzes
Route::get('/quiz/{lessonId}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{lessonId}/submit', [QuizController::class, 'submit'])->name('quiz.submit');

// Certificate
Route::get('/certificate', [CertificateController::class, 'index'])->name('certificate');
Route::post('/certificate/generate', [CertificateController::class, 'generate'])->name('certificate.generate');
Route::get('/certificate/download/{user_id}/{format}', [CertificateController::class, 'download'])->name('certificate.download');

// User Profile
Route::post('/user/update-profile', [UserController::class, 'updateProfile'])->name('user.update-profile');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    
    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Lessons CRUD
        Route::resource('lessons', AdminLessonController::class);
        
        // Quizzes CRUD
        Route::resource('quizzes', AdminQuizController::class);
        
        // Exercises CRUD
        Route::resource('exercises', AdminExerciseController::class);
        
        // Simulators CRUD
        Route::resource('simulators', AdminSimulatorController::class);
    });
});