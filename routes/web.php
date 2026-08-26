<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProblemController as AdminProblemController;
use App\Http\Controllers\Admin\SolutionController as AdminSolutionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Root: send to the right place depending on session state
Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    return Auth::user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('dashboard');
});

// Guest-only auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// / Regular user routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');

    Route::get('/problems', [ProblemController::class, 'index'])->name('problems.index');
    Route::get('/problems/search', [ProblemController::class, 'search'])->name('problems.search');
    Route::get('/problems/{problem}', [ProblemController::class, 'show'])->name('problems.show');

    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports', [ReportController::class, 'userReports'])->name('reports.index');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('/problems', [AdminProblemController::class, 'index'])->name('problems.index');
    Route::post('/problems', [AdminProblemController::class, 'store'])->name('problems.store');
    Route::put('/problems/{problem}', [AdminProblemController::class, 'update'])->name('problems.update');
    Route::delete('/problems/{problem}', [AdminProblemController::class, 'destroy'])->name('problems.destroy');

    Route::get('/solutions', [AdminSolutionController::class, 'index'])->name('solutions.index');
    Route::post('/solutions', [AdminSolutionController::class, 'store'])->name('solutions.store');
    Route::put('/solutions/{solution}', [AdminSolutionController::class, 'update'])->name('solutions.update');
    Route::delete('/solutions/{solution}', [AdminSolutionController::class, 'destroy'])->name('solutions.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
