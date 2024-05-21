<?php

use App\Livewire\Admin\CategoryComponent;
use App\Livewire\Admin\DashboardComponent;
use App\Livewire\Admin\QuestionComponent;
use App\Livewire\Admin\QuizComponent;
use App\Livewire\QuizTakingComponent;
use App\Livewire\UserDashboardComponent;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', UserDashboardComponent::class)->name('dashboard');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', DashboardComponent::class)->name('admin.dashboard');
    Route::get('/quizzes', QuizComponent::class)->name('admin.quizzes');
    Route::get('/questions', QuestionComponent::class)->name('admin.questions');
    Route::get('/categories', CategoryComponent::class)->name('admin.categories');
});

// Quiz Taking Route
Route::middleware(['auth', 'verified'])->get('/quizzes/{quizId}', QuizTakingComponent::class)->name('quizzes.take');

require __DIR__.'/auth.php';
