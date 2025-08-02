<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', function () {
    return view('employee');
});


Route::get('counter', App\Livewire\Counter::class);


Route::get('user', App\Livewire\User\User::class)->name('user-list');
Route::get('user/tambah', App\Livewire\User\Tambah::class)->name('user-tambah');
Route::get('user/edit/{id}', App\Livewire\User\Edit::class);
