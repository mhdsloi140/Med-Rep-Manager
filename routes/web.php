<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DelegateController;
use App\Http\Controllers\Dashboard\DoctorControkker;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RegionController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SamplesController;
use App\Http\Controllers\Dashboard\TicekController;
use App\Http\Controllers\Dashboard\TicetRepalyController;
use App\Http\Controllers\Dashboard\TicketController;

use App\Http\Controllers\Dashboard\DelegateSupervisorController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\UserRoleController;
use App\Http\Controllers\Dashboard\VistiController;
// use App\Http\Controllers\Dashborad\RoleController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TestController;
use App\Models\Admin;
use App\Models\Region;
use App\Models\User;
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

Broadcast::routes(['middleware' => ['auth']]);
Route::get('/get-areas/{city_id}', [RegionController::class, 'getByCity'])->name('get.areas');

Route::get('/',[TestController::class,'index'])->name('test');
// Route::get('test',[TestController::class,'index'])->name('test');

Route::get('login', [AuthController::class, 'index'])->name('login');

Route::post('login', [AuthController::class, 'store'])->name('login.store');

Route::prefix('admin')->middleware('auth')->group(function () {
    // Route::get('admin/list', [AdminController::class, 'index'])->name('admin.index');
    // Route::get('admin/create',[AdminController::class,'create'])->name('admin.create');
    // Route::post('admin/store',[AdminController::class,'store'])->name('admin.store');

    Route::resource('admin',AdminController::class);
    Route::get('logout',[AuthController::class,'destroy'])->name('logout');
    Route::resource('delegateSupervisor',DelegateSupervisorController::class);
    Route::resource('delegate',DelegateController::class);
    Route::get('swap',[LanguageController::class,'swap'])->name('swap');
    Route::resource('city', CityController::class);
    Route::resource('doctor',DoctorController::class);
    Route::resource('visit',VistiController::class);
    Route::resource('company',CompanyController::class);
    Route::resource('sample',SamplesController::class);
    Route::resource('dashboard',DashboardController::class);
    Route::resource('tickets',TicekController::class);
    Route::resource('replay',TicetRepalyController::class);
    Route::resource('profile',ProfileController::class);
    Route::resource('region',RegionController::class);
    Route::get('/users/assign-role', [UserRoleController::class, 'create'])->name('users.assign.role');
    Route::post('/users/assign-role', [UserRoleController::class, 'store'])->name('users.assign.role.store');
    Route::put('update-viti/{id}',[VistiController::class,'update_visti'])->name('uptata_visti');
    // Route::get('/get-areas/{city_id}', [RegionController::class, 'getByCity']);
    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
    // Route::resource('comment',CommentController::class);
    Route::get('comment/{id}', [CommentController::class, 'create'])->name('comment.create');
    Route::post('comment', [CommentController::class, 'store'])->name('comment.store');

});
Route::prefix('delegateSupervisor')->middleware('auth')->group(function(){

    // Route::resource('visti',VistiController::class);

    Route::resource('ticket', TicekController::class);





});
