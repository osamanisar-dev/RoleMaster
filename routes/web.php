<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});

Route::redirect('/','/users');

Auth::routes();
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('user.show');
    Route::post('/user', 'store')->name('user.store')->middleware('role:Admin');
});


Route::controller(RoleController::class)->group(function () {
    Route::get('/roles', 'index')->name('role.show');
    Route::post('/role', 'store')->name('role.store')->middleware('role:Admin');
});

Route::controller(PermissionController::class)->group(function () {
    Route::get('/permissions', 'index')->name('permission.show');
    Route::post('/permission', 'store')->name('permission.store');
});


