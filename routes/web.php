<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventListController;
use App\Http\Controllers\InviteController;

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
    return redirect('login');
});

Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// Auth::routes();

 
Route::get('/invites-token/{token}', [InviteController::class, 'accept'])->name('invites.accept');

Route::get('/eventslist', [EventListController::class, 'index'])->name('eventslist');
Route::get('/events-status', [EventListController::class, 'status'])->name('events.status');
Route::post('/eventslist-all', [EventListController::class, 'list'])->name('eventslist.all');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/events', [EventController::class, 'index'])->name('events');
    Route::get('event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('event', [EventController::class, 'store'])->name('event.store');
    Route::get('event/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::get('event/{event}', [EventController::class, 'show'])->name('event.show');
    Route::put('event/{event}', [EventController::class, 'update'])->name('event.update');
    Route::delete('event/{event}', [EventController::class, 'destroy'])->name('event.destroy');
    
    Route::get('/invites', [InviteController::class, 'index'])->name('invites');
    Route::post('/invites-all', [InviteController::class, 'list'])->name('invites.all');
    Route::post('invites', [InviteController::class, 'store'])->name('invites.store');
    Route::post('/invites-delete', [InviteController::class, 'destroy'])->name('invites.destroy');

});