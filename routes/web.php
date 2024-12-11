<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DashboardController::class, 'home'])->name('home');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/{slug}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{slug}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{slug}', [BookController::class, 'destroy'])->name('books.destroy');
    // checkout
    Route::put('/books/{slug}/checkout', [BookController::class, 'showCheckout'])->name('books.checkout');

});

// books route
Route::get('/catalog', [BookController::class, 'showBooks'])->name('catalog');

Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{slug}', [BookController::class, 'showDetails'])->name('books.detail');
// Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
// Route::resource('books', BookController::class)->only(['create']);

require __DIR__.'/auth.php';