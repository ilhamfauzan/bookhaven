<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CheckoutController;

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
    Route::put('/checkout/{slug}', [CheckoutController::class, 'show'])->name('checkout.index');
    Route::post('/checkout/{slug}', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/{slug}/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::put('/checkout/{slug}/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

    // history
    Route::get('/transaction/history', [TransactionController::class, 'show'])->name('transaction.history');
    Route::post('/transaction/cancel/{id}', [TransactionController::class, 'cancel'])->name('transaction.cancel');

    // edit history
    Route::get('/transaction/edit/{id}', [TransactionController::class, 'edit'])->name('transaction.edit');
    Route::put('/transaction/edit/{id}', [TransactionController::class, 'update'])->name('transaction.update');

    // Route::get('/catalog', [BookController::class, 'showBooks'])->name('catalog');

    // Route::post('/books', [BookController::class, 'store'])->name('books.store');
    // Route::get('/books/{slug}', [BookController::class, 'showDetails'])->name('books.detail');

});

// books route public
Route::get('/catalog', [BookController::class, 'showBooks'])->name('catalog');

Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{slug}', [BookController::class, 'showDetails'])->name('books.detail');

require __DIR__.'/auth.php';
