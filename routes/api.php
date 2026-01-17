<?php

//use App\Http\Controllers\Admin\TelegramController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::resource('/telegram',TelegramController::class);
Route::resource('/order',OrderController::class);
Route::resource('/telegramleads',TelegramController::class);