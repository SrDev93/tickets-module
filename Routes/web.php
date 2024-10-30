<?php

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
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::resource('tickets', 'TicketsController');
    Route::resource('ticketDepartment', 'TicketDepartmentController');
    Route::post('tickets/reply/{ticket}', 'TicketsController@reply')->name('tickets.reply');
    Route::post('ticket/status/{ticket}', 'TicketsController@status')->name('tickets.status');
});
