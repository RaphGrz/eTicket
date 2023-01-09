<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

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

Route::get('/dashboard', 'App\Http\Controllers\TicketController@dashboard')->name('dashboard');
Route::get('/', 'App\Http\Controllers\TicketController@index')->name('index');
Route::post('/ticket/search', 'App\Http\Controllers\TicketController@search')->name('search-ticket');
Route::get('/ticket/create', 'App\Http\Controllers\TicketController@create')->name('create-ticket');
Route::post('/ticket/create', 'App\Http\Controllers\TicketController@store')->name('store-ticket');
Route::post('/ticket/comment', 'App\Http\Controllers\TicketController@comment')->name('store-comment');
Route::get('/ticket/comment/file/{id}', 'App\Http\Controllers\TicketController@download')->name('download-file');
Route::get('/ticket/{id}', 'App\Http\Controllers\TicketController@ticket')->name('ticket');
Route::patch('/ticket/{id}', 'App\Http\Controllers\TicketController@update')->name('ticket.update');

Route::get('/profil/list', 'App\Http\Controllers\ProfileController@list')->name('profile.list');

Route::get('/service', 'App\Http\Controllers\ServiceController@service')->name('service');
Route::post('/service/create', 'App\Http\Controllers\ServiceController@store')->name('store-service');
Route::delete('/service/{id}', 'App\Http\Controllers\ServiceController@destroy')->name('service.destroy');

Route::middleware('auth')->group(function () {
    Route::post('/profil/search', 'App\Http\Controllers\ProfileController@search')->name('search-user');
    Route::get('/profil/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profil/{id}', [ProfileController::class, 'updateService'])->name('profile.service-update');
    Route::delete('/profil/service/{id}', [ProfileController::class, 'destroyService'])->name('profile.service-destroy');
});

require __DIR__ . '/auth.php';
