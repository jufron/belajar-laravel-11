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
Route::get('produk', App\Livewire\Produk\Produk::class)->name('produk');

Route::prefix('user')->group( function () {
    Route::get('/', App\Livewire\User\User::class)->name('user');
    Route::get('tambah', App\Livewire\User\Tambah::class)->name('user-tambah');
    Route::get('show/{user}', App\Livewire\User\UserShow::class)->name('user-show');
    ROute::get('edit/{user}', App\Livewire\User\UserEdit::class)->name('user-edit');
    Route::get('delete/{user}', App\Livewire\User\UserDelete::class)->name('user-delete');
});
