<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupportUserController;
use App\Http\Controllers\Auth\SupportRegisteredUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TicketController;
use App\Models\Ticket;
use App\Http\Controllers\GiftCardController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserGateController;
use App\Http\Controllers\TicketSendController;
use App\Http\Controllers\UserTicketController;
use App\Http\Controllers\Auth\SupportUserLoginController;
use App\Http\Middleware\SupportUserMiddleware;
use App\Http\Controllers\QrCodeController;

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


Route::get('/', function () {return view('welcome');})->name('welcome');

Route::get('/usergate', [UserGateController::class, 'index'])->name('giftcards_index');


Route::middleware(['guest:supportusers'])->group(function () {
        Route::get('/suplogin', [SupportUserLoginController::class, 'create'])->name('supportuser_login');
        Route::post('/suplogin', [SupportUserLoginController::class, 'store']);
    });
    
Route::middleware(['auth:supportusers', 'supportuser', 'supportuser'])->group(function () {
    Route::get('/support/home', [SupportUserController::class, 'index'])
        ->name('support_home');    
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->is_support) {
            return view('welcome');
        } else {
            return view('usergate');
        }
    })->name('dashboard');
    
    //ログイン後のマイページ
    Route::get('/user/home', [UserController::class, 'index'])->name('user_home');
    
    

    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'store'])->name('login');
        Route::post('/login', [LoginController::class, 'create']);
    });
    
    
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});


    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')
        ->middleware('web','auth:supportusers')
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
        ->middleware('signed');
    
    Route::middleware(['guest:supportusers'])->group(function () {
        Route::get('/suplogin', [SupportUserLoginController::class, 'create'])->name('supportuser_login');
        Route::post('/suplogin', [SupportUserLoginController::class, 'store']);
    });


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
Route::get('/user/myticket', [TicketController::class, "myticket"])->name('myticket_index');
Route::post('user//myticket/use/{ticket}', [TicketController::class, "useTicket"])->name('myticket_use');
Route::post('user//myticket/used/{ticket}', [TicketController::class, "usedTicket"])->name('myticket_used');


    
    // giftcard選択ルート
Route::get('/giftcards', [GiftCardController::class, 'index'])->name('giftcards_data');
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

//ticketをuserが取得した場合のticket_table処理
Route::post('/tickets/get', [TicketController::class, 'get'])->middleware('auth')->name('tickets.get');

//ticketをuserが取得した場合の処理
// Route::middleware(['auth'])->group(function () {
//     Route::get('/myticket', [UserTicketController::class, 'myticket'])->name('myticket');
// });

//ticketをuserが取得した場合のticket_table処理
// Route::post('/user/myticket/email/form', [TicketSendController::class, 'ticketsend'])->middleware('auth')->name('ticket_mailform');
Route::GET('/user/myticket/email/form/email', [TicketSendController::class, 'send_announce'])->middleware('auth')->name('ticket_post_announce');
Route::post('/user/myticket/email/form/email/update', [TicketSendController::class, 'send'])->middleware('auth')->name('ticket_email_update');
Route::get('/user/myticket/email/form', [TicketSendController::class, 'ticketsend'])->name('ticket_mailform');
Route::post('/user/myticket/email/content', [TicketSendController::class, 'ticketcontent'])->name('ticket_email_content');


Route::get('/qrcode', [QrCodeController::class, 'index']);

require __DIR__.'/auth.php';
