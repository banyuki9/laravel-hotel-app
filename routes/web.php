<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [App\Http\Controllers\DashboardfController::class, 'index'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('dashboard');

// Rooms
Route::get('/rooms', [App\Http\Controllers\RoomsController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [App\Http\Controllers\RoomsController::class, 'show'])->name('rooms.show')->where('id', '[0-9]+');
Route::get('/rooms/create', [App\Http\Controllers\RoomsController::class, 'create'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('rooms.create');
Route::post('/rooms', [App\Http\Controllers\RoomsController::class, 'store'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('rooms.store');

require __DIR__.'/auth.php';
