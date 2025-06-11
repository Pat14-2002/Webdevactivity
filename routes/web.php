<?php
  
 use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\AuthCheck;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Default Route - Login View
Route::get('/', function () {
    return view('auth.login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); // Ensure login handling exists

// Middleware-protected routes
Route::middleware([AuthCheck::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout'); // Logout should be POST, not GET
    Route::get('/dashboard', [UserController::class, 'index'])->name('users.index'); // Ensure a valid redirect exists
});

// User Management Routes
Route::post('/users', [UserController::class, 'store'])->name('user.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit'); // Add an edit route for form access
Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy'); // Optional delete user route


