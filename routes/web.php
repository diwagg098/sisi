<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\User\UserController;
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

Route::group(['middleware' => 'auth'], function() {

    // User router
    Route::group(['prefix' => 'users'], function() {
        Route::post('/add-user', [UserController::class, 'add_user'])->name('users.add');
        Route::get('/add-user', [UserController::class, 'add_user_view']);
        Route::get('/', [UserController::class, 'user_view']);
        Route::get('/edit/{id}', [UserController::class, 'show']);
        Route::post('/edit/{id}', [UserController::class, 'update']);
        Route::get('/edit/access/{id}', [UserController::class, 'edit_access_view']);
        Route::put('/edit/access/{id}', [UserController::class, 'edit_access']);
        Route::put('/delete/{id}', [UserController::class, 'destroy']);
    });

    // Menu Router
    Route::group(['prefix' => 'menu'], function() {
        Route::get('/', [MenuController::class,'index']);
        Route::get('/create', [MenuController::class, 'create']);
        Route::post('/', [MenuController::class,'store']);
        Route::put('/{id}',[MenuController::class, 'update']);
        Route::get('/edit/{id}', [MenuController::class, 'edit']);
        Route::delete('/{id}',[MenuController::class, 'destroy']);
    });

    Route::group(['prefix' => 'activity'], function() {
        Route::get('/', [ActivityController::class,'index']);
    });

    Route::group(['prefix' => 'karyawan'], function() {
        Route::get('/', [KaryawanController::class,'index']);
        Route::get('/edit/{id}', [KaryawanController::class,'edit']);
        Route::put('/update/{id}', [KaryawanController::class,'update']);
    });


});

Route::get('auth/login', [AuthController::class, 'login_view']);
Route::post('/auth/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/logout',[AuthController::class,'logout']);
