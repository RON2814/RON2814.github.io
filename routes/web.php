<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Welcome Page
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('student.dashboard');
    }
    return redirect()->route('login');
})->name("index");

Route::fallback(function () {
    return redirect()->route('index');
});

// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view("/view-test", "layout.app");


// Include Admin Routes
require __DIR__ . '/admin.php';

// Include Registrar Routes
require __DIR__ . '/registrar.php';

// Include Department Routes
require __DIR__ . '/department.php';

// Include Student Routes
require __DIR__ . '/student.php';

// Include Auth Routes
require __DIR__ . '/auth.php';
