<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::post('/users/mail/{email}', [App\Http\Controllers\UserController::class, 'sendMail'])->name('users.mail');
    Route::post('/users/disable', [App\Http\Controllers\UserController::class, 'disableUser'])->name('users.disable');

    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('/products', App\Http\Controllers\ProductController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/categories', App\Http\Controllers\CategoryController::class);
});


Route::middleware(['web'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome']);
    Route::post('/message', [App\Http\Controllers\HomeController::class, 'message'])->name('send.message');
    Route::get('error', [App\Http\Controllers\HomeController::class, 'error'])->name('error');
});

