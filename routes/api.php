<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BobotController;

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

Route::get('/bobot/getAllTipe',[BobotController::class, 'api_getAllTipe']);
Route::get('/bobot/getByTipe/{tipe}',[BobotController::class, 'api_getByTipe']);


