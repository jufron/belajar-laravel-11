<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(UserController::class)->group( function () {
    Route::get('fetch-user', 'fetchUser')->name('fetch-user');
    Route::get('user', 'user');
    Route::get('user-table', 'userTable');
    Route::get('user-yajra-datatable', 'userYajraDatatable');
    Route::get('getuser', 'getData')->name('get.user');
    Route::get('user/{id}', 'show')->name('get.user.id');
    Route::patch('user/{id}', 'update')->name('update.user.id');
    Route::post('user', 'store')->name('store.user');
    Route::delete('user/{id}', 'destroy')->name('delete.user.id');
});
