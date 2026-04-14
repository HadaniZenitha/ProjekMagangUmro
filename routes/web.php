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
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route untuk mengambil data NID di register form
Route::get('/register/get-nid-data', [\App\Http\Controllers\Auth\RegisterController::class, 'getNidData'])->name('register.getNidData');

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

Route::get('/barang/export-excel', [BarangController::class, 'exportExcel'])->name('barang.exportExcel');
        
Route::get('/barang/export-pdf', [BarangController::class, 'exportPdf'])->name('barang.exportPdf');

Route::get('/barang/export-preview', [BarangController::class, 'exportPreview'])
    ->name('barang.exportPreview');

Route::middleware(['auth'])->group(function () {
    Route::post('/barang/import', [BarangController::class, 'import'])->name('barang.import');
    Route::resource('barang', BarangController::class);
    });

    Route::get('/scan', [BarangController::class, 'scanPage'])
        ->name('barang.scan');

    Route::get('/scan/{kode}', [BarangController::class, 'scan'])
        ->where('kode', '.*')
        ->name('barang.scan.process');

    Route::middleware(['auth'])->group(function () {
        Route::post('/pic/import', [PicController::class, 'import'])->name('pic.import');
        Route::resource('pic', PicController::class);
    });
  
Route::get('/get-pic-by-divisi/{divisi}', 
    [PicController::class, 'getByDivisi']);

Route::get('/barang/export', [BarangController::class, 'export'])
      ->name('barang.export');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])
->name('profile.update');

Route::resource('barang-sewa', SewaController::class)
    ->parameters(['barang-sewa' => 'sewa']
);
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('users', UserController::class);
});
Route::get('/barang/{barang}/cetak', [BarangController::class, 'cetak'])
    ->name('barang.cetak');
Route::get('/barang/{kode}/barcode', [BarangController::class, 'barcode'])->name('barang.barcode');