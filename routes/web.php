<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupuserController;
use App\Http\Controllers\Auth\SupportRegisteredUserController;
use App\Http\Controllers\Auth\RegisteredUserController;


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

// 一般ユーザー登録用のルート
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

// 支援ユーザー登録用のルート
Route::get('/supuser_register', [SupportRegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('supuser_register');

Route::post('/supuser_register', [SupportRegisteredUserController::class, 'store'])
    ->middleware('guest');


//ログイン後のマイページ
Route::get('/user/home', [UserController::class, 'create'])->name('user_home');

Route::get('/supuser/home', [SupUserController::class, 'create'])->name('supuser_home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
