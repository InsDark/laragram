<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;

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
use App\Models\Image;

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', function () {
    return view('user.login');
})->name('login');
Route::get('register', function () {
    return view('user.register');
});

Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

Route::get('profile/{id}', [UserController::class, 'profile']);

Route::get('/upload', function() {
    return view('user.upload');
})->name('upload');

Route::get('users', [UserController::class, 'users'])->name('users');

Route::get('post/{id}', [UserController::class, 'post'])->name('post');

Route::get('favorites', [UserController::class, 'favorites']);

Route::group(['prefix'=>'user'], function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::get('close', [UserController::class, 'close']);
    Route::post('upload', [UserController::class, 'upload']);
    Route::get('like/{id}', [UserController::class, 'like']);
});
