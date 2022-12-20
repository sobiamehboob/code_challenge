<?php

use Illuminate\Support\Facades\Route;

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




Route::post('user/connect', [App\Http\Controllers\UserRequestController::class, 'send_request'])->name('connect');
Route::post('user/request', [App\Http\Controllers\UserRequestController::class, 'cancle_request_connection_or_accept_request'])->name('delete');
