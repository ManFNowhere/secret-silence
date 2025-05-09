<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReleasedController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/about', [IndexController::class, 'about'])->name('about');

Route::resource('released', ReleasedController::class);
Route::resource('software', SoftwareController::class);


Route::middleware(AuthMiddleware::class)->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/about-form', [UserController::class, 'aboutForm'])->name('about-form');
    Route::post('/about-form/{textObject}', [UserController::class, 'aboutFormPost'])->name('about-form-post');
    Route::get('/software-form', [UserController::class, 'softwareForm'])->name(name: 'software-form');
    Route::post('/software-form/{textObject}', [UserController::class, 'softwareFormPost'])->name('software-form-post');
    Route::put('/sosmed/update', [UserController::class, 'sosmedUpdate'])->name('sosmed-update');
    Route::post('add-song', [UserController::class, 'addSong'])->name('add-song');
    Route::get('/edit-song/{song}', [UserController::class, 'editSong'])->name('edit-song');
    Route::put('/update-song/{song}', [UserController::class, 'updateSong'])->name('update-song');
    Route::delete('/delete-song/{song}', [UserController::class, 'deleteSong'])->name('delete-song');
});



// auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/test', function () {
    return view('welcome');
});
