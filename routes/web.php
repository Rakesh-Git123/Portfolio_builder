<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\AboutMeController;
use App\Http\Controllers\ProjectController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/',[PortfolioController::class,"index"] )
->name('dashboard')
->middleware('isAuthenticated');

Route::middleware('isAuthenticated')->group(function () {
    Route::resource('portfolios', PortfolioController::class);
    Route::resource('portfolios/{portfolioId}/skills', SkillController::class);
    Route::resource('portfolios/{portfolioId}/experiences', ExperienceController::class);
    Route::resource('portfolios/{portfolioId}/education', EducationController::class);
    Route::resource('portfolios/{portfolioId}/about-me', AboutMeController::class);
    Route::resource('portfolios/{portfolioId}/projects', ProjectController::class);

});
