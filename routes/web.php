<?php

use App\Jobs\CreateManyUser;
use App\Jobs\ProcessPodcast;
use App\Jobs\ReportCSV;
use App\Jobs\ReportExcel;
use App\Jobs\ReportPDF;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/generate', function () {
    CreateManyUser::dispatch('user 1');
    return '<h1>Sedan Memproses Create User, Mohon menunggu</h1>';
});

Route::get('laporan/excel', function () {
    ReportExcel::dispatch()->delay(now()->addMinutes(3));
    return '<h1>Sedang Memproses Laporan Excel Mohon Menunggu</h1>';
});

Route::get('laporan/pdf', function () {
    ReportPDF::dispatch()->delay(now()->addMinutes(5));
    return '<h1>Sedang Memproses Laporan PDF Mohon Menunggu</h1>';
});

Route::get('laporan/csv', function () {
    ReportCSV::dispatch()->delay(now()->addMinutes(10));
    return '<h1>Sedang Memproses Laporan CSV Mohon Menunggu</h1>';
});
Route::get('process/podcast', function () {
    ProcessPodcast::dispatch();
    return '<h1>Sedang Memproses</h1>';
});
