<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupUserController;
use App\Http\Controllers\Auth\SupportRegisteredUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TicketController;
use App\Models\Ticket;
use App\Http\Controllers\GiftCardController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserGateController;
use App\Http\Controllers\UserTicketController;
use App\Http\Controllers\Auth\SupportUserLoginController;

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


Route::get('/', function () {
    return view('welcome');
});
Route::get('/usergate', [UserGateController::class, 'index'])->name('giftcards_index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'store'])->name('login');
        Route::post('/login', [LoginController::class, 'create']);
    });
    
    Route::middleware(['guest:supportusers', 'web'])->group(function () {
        Route::get('/supplogin', [SupportUserLoginController::class, 'create'])->name('supportuser_login');
        Route::post('/supplogin', [SupportUserLoginController::class, 'store']);
    });
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});


//ログイン後のマイページ
Route::get('/user/home', [UserController::class, 'index'])->name('user_home');

Route::get('/supuser/home', [SupUserController::class, 'index'])->name('supuser_home');


// 支援ユーザーみらいチケット用のルート



Route::resource('/supuser/suptickets', TicketController::class)->names([
    'index' => 'supticket_index',
    'create' => 'supticket_create',
    'store' => 'supticket_store'
]);

Route::post('/supuser/suptickets/edit/{ticket}',[TicketController::class,"edit"])->name('supticket_edit'); //通常
Route::get('/supuser/suptickets/edit/{ticket}',[TicketController::class,"edit"])->name('supticket_editor'); //通常
Route::post('/supuser/suptickets/update',[TicketController::class,"update"])->name('supticket_update');
Route::delete('/supuser/suptickets/{ticket}', [TicketController::class, "destroy"])->name('supticket_delete')->where('ticket', '[0-9]+');

    
    // giftcard選択ルート
Route::get('/giftcards', [GiftCardController::class, 'index'])->name('giftcards_index');
Route::post('/giftcards', [GiftCardController::class, 'store'])->name('giftcards_store');

Route::resource('/user/tickets', UserTicketController::class)->names([
    'index' => 'ticket_index',
    'create' => 'ticket_create',
    'store' => 'ticket_store'
]);

Route::get('/user/tickets/show/{ticket}',[UserTicketController::class,"show"])->name('ticket_show'); //通常
Route::post('/user/tickets/edit/{ticket}',[UserTicketController::class,"edit"])->name('ticket_edit'); //通常
Route::get('/user/tickets/edit/{ticket}',[UserTicketController::class,"edit"])->name('ticket_editor'); //通常
Route::post('/user/tickets/update',[UserTicketController::class,"update"])->name('ticket_update');
Route::delete('/user/tickets/{ticket}', [UserTicketController::class, "destroy"])->name('ticket_delete')->where('ticket', '[0-9]+');



require __DIR__.'/auth.php';
