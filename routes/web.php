<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('hello', function () {
    return view('employee');
});

Route::get('/', App\Livewire\Home::class)->name('home');
Route::get('about', App\Livewire\About::class)->name('about');
Route::get('contact', App\Livewire\Contact::class)->name('contact');
Route::get('user', App\Livewire\User\User::class)->name('user');
Route::get('produk', App\Livewire\Produk\Produk::class)->name('produk');

Route::get('counter', App\Livewire\Counter::class);


Route::get('user/tambah', App\Livewire\User\Tambah::class)->name('user-tambah');
Route::get('user/edit/{id}', App\Livewire\User\Edit::class);
