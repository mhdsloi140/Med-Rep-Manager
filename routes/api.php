<?php

use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\TicketReolayController;
use App\Http\Controllers\API\TicketReplayController;
use App\Http\Controllers\API\VistiController;
use App\Http\Controllers\TestController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',[AuthApiController::class,'login'])->name('login');
// Route::post('login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
   Route::resource('replay',TicketReplayController::class);
});
Route::get('test',[TestController::class,'index']);
Route::middleware('auth:sanctum')->prefix('delegate')->group(function () {
     Route::resource('ticket',TicketController::class);
    //  Route::resource('visits', VistiController::class);
    Route::get('index',[VistiController::class,'index']);
     Route::get('index', [VistiController::class,'index']);



});
