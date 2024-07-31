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

Route::get('/', [\App\Http\Controllers\userControlle::class, 'index'])->name('home');

Route::get('/match', [\App\Http\Controllers\MatchsController::class, 'index']);
Route::get('/teams', [\App\Http\Controllers\TeamController::class, 'index']);
Route::get('/stadium/{field}', [\App\Http\Controllers\FieldController::class, 'show'])->name('stadium');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('redirects');
    })->name('dashboard');
});

route::group(['middleware' => 'auth'], function () {
    Route::get('redirects', [\App\Http\Controllers\userControlle::class, 'index'])->name('redirects');

    Route::get('/hi', function () {
        return view('teams');
    });
    Route::middleware(['is_user'])->get('/book/{id}', [\App\Http\Controllers\TicketController::class, 'index'])->name('book');
    Route::middleware(['is_user'])->post('/checkout', [\App\Http\Controllers\TicketController::class, 'create'])->name('checkout');
    Route::middleware(['is_user'])->get('/ticket/{ticket}', [\App\Http\Controllers\TicketController::class, 'show'])->name('ticket');
    Route::middleware(['is_user'])->get('/pdf/{id}', [\App\Http\Controllers\TicketController::class, 'pdf'])->name('download');
    Route::middleware(['is_user'])->get('/myticket', [\App\Http\Controllers\TicketController::class, 'store'])->name('myticket');





    Route::group(['middleware' => 'is_admin'], function () {
    });
});
