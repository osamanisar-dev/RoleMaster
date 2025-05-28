<?php

use App\Http\Controllers\PermissionContoller;
use App\Http\Controllers\RoleContoller;
use App\Http\Controllers\UserContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});

Route::redirect('/','/users');

Auth::routes();
Route::controller(UserContoller::class)->group(function () {
    Route::get('/users', 'index')->name('user.show');
    Route::post('/user', 'store')->name('user.store')->middleware('role:Admin');
});


Route::controller(RoleContoller::class)->group(function () {
    Route::get('/roles', 'index')->name('role.show');
    Route::post('/role', 'store')->name('role.store')->middleware('role:Admin');
});

Route::controller(PermissionContoller::class)->group(function () {
    Route::get('/permissions', 'index')->name('permission.show');
    Route::post('/permission', 'store')->name('permission.store');
});


