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
})->name('top');

Route::get('/dashboard', [App\Http\Controllers\DashboardfController::class, 'index'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('dashboard');

// Rooms
Route::get('/rooms', [App\Http\Controllers\RoomsController::class, 'index'])->name('rooms.index');
Route::get('/rooms/create', [App\Http\Controllers\RoomsController::class, 'create'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('rooms.create');
Route::post('/rooms', [App\Http\Controllers\RoomsController::class, 'store'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('rooms.store');
Route::get('/rooms/{id}', [App\Http\Controllers\RoomsController::class, 'show'])->name('rooms.show')->where('id', '[0-9]+');
Route::get('/rooms/{id}/edit', [App\Http\Controllers\RoomsController::class, 'edit'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('rooms.edit')->where('id', '[0-9]+');
Route::patch('/rooms/{id}/update', [App\Http\Controllers\RoomsController::class, 'update'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('rooms.update')->where('id', '[0-9]+');
Route::delete('/rooms/{id}', [App\Http\Controllers\RoomsController::class, 'delete'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('rooms.destroy')->where('id', '[0-9]+');

// Plans
Route::get('/plan/{id}/create', [App\Http\Controllers\PlanController::class, 'create'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('plan.create');
Route::post('/plan/{id}', [App\Http\Controllers\PlanController::class, 'store'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('plan.store');
Route::get('/plan/{id}/edit/{plan_id}', [App\Http\Controllers\PlanController::class, 'edit'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('plan.edit');
Route::patch('/plan/{id}/update/', [App\Http\Controllers\PlanController::class, 'update'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('plan.update');
Route::delete('/plan/{id}', [App\Http\Controllers\PlanController::class, 'delete'])->middleware(['auth', 'verified', 'can:isAdmin'])->name('plan.destroy')->where('id', '[0-9]+');

// Books
Route::get('/book', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');
Route::get('/book/create', [App\Http\Controllers\BookController::class, 'create'])->middleware(['auth', 'verified', 'hasBookData'])->name('book.create');
Route::post('/book/store-book-data', [App\Http\Controllers\BookController::class, 'storeBookData'])->name('book.store-book-data');
Route::get('/book/payment', [App\Http\Controllers\BookController::class, 'createBookPayment'])->middleware(['auth', 'verified','hasBookData', 'hasCustomerData'])->name('book.payment');
Route::post('/book/payment', [App\Http\Controllers\BookController::class, 'storeCustomerData'])->middleware(['auth', 'verified', 'hasBookData'])->name('book.store-customer-data');
Route::post('/book', [App\Http\Controllers\StripePaymentsController::class, 'payment'])->middleware(['auth','verified', 'hasBookData', 'hasCustomerData'])->name('book.store-payment');
Route::get('/book/complete/{id}', [App\Http\Controllers\BookController::class, 'complete'])->middleware(['auth', 'verified'])->name('book.complete');
Route::get('/book/{user_id}', [App\Http\Controllers\BookController::class, 'userBookIndex'])->middleware(['auth', 'verified', 'correctUserId'])->name('book.user-books');
Route::get('/book/{user_id}/{book_code}', [App\Http\Controllers\BookController::class, 'userBookShow'])->middleware(['auth', 'verified', 'correctUserId'])->name('book.user-book-show');


require __DIR__.'/auth.php';
