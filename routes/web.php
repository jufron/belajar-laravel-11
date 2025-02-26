<?php

use App\Http\Controllers\UserAuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(UserAuthenticationController::class)->group( function () {
    Route::get('dashboard', 'index');
    Route::get('register', 'register');
});