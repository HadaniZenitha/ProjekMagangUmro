<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\KelompokBarangController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\SubJenisBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\LantaiController;
use App\Http\Controllers\JenisRuanganController;
use App\Http\Controllers\PicController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('ruangs', RuangController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('kelompok', KelompokBarangController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('divisi', DivisiController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('gedung', GedungController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('lantai', LantaiController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('jenis-ruangan', JenisRuanganController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('jenis', JenisBarangController::class)
        ->parameters(['jenis' => 'jenis']);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('subjenis', SubJenisBarangController::class)
        ->parameters(['subjenis' => 'subjenis']);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::get('/scan/{kode}', [BarangController::class, 'scan'])
    ->name('barang.scan');
    });
    
Route::middleware(['auth'])->group(function () {
    Route::resource('pic', PicController::class);
});
    
Route::get('/get-pic-by-divisi/{divisi}', 
    [PicController::class, 'getByDivisi']);


