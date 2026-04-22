<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import Controllers
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\JenisRuanganController;
use App\Http\Controllers\KelompokBarangController;
use App\Http\Controllers\LantaiController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\SubJenisBarangController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route khusus Register
Route::get('/register/get-nid-data', [RegisterController::class, 'getNidData'])
    ->name('register.getNidData');

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// =============================================
// ROUTES EXPORT & UTILITY
// =============================================
Route::get('/barang/export-excel', [BarangController::class, 'exportExcel'])
    ->name('barang.exportExcel');

Route::get('/barang/export-pdf', [BarangController::class, 'exportPdf'])
    ->name('barang.exportPdf');

Route::get('/barang/export-preview', [BarangController::class, 'exportPreview'])
    ->name('barang.exportPreview');

Route::get('/barang/export', [BarangController::class, 'export'])
    ->name('barang.export');
    
// =============================================
// ROUTES YANG MEMBUTUHKAN AUTHENTICATION
// =============================================
Route::middleware(['auth'])->group(function () {

    // Master Data Lokasi
    Route::resource('ruangs', RuangController::class);
    Route::resource('gedung', GedungController::class);
    Route::resource('lantai', LantaiController::class);
    Route::resource('jenis-ruangan', JenisRuanganController::class);

    // Master Data Barang
    Route::resource('kelompok', KelompokBarangController::class);
    Route::resource('jenis', JenisBarangController::class)
        ->parameters(['jenis' => 'jenis']);
    Route::resource('subjenis', SubJenisBarangController::class)
        ->parameters(['subjenis' => 'subjenis']);

    // Master Data Lainnya
    Route::resource('divisi', DivisiController::class);
    Route::resource('pic', PicController::class);
    Route::post('/pic/import', [PicController::class, 'import'])->name('pic.import');

    // Barang Utama
    Route::resource('barang', BarangController::class);
    Route::post('/barang/import', [BarangController::class, 'import'])->name('barang.import');

    // Barang Sewa
    Route::resource('barang-sewa', SewaController::class)
        ->parameters(['barang-sewa' => 'sewa']);

    // User Management (hanya superadmin)
    Route::middleware('role:superadmin')->group(function () {
        Route::resource('users', UserController::class);
    });
});


// =============================================
// SCAN BARANG
// =============================================

// 1. HALAMAN SCANNER
Route::get('/scan', [BarangController::class, 'scanPage'])
    ->name('scan.page')
    ->middleware('auth');

// 2. REDIRECT DARI QR (TIDAK PERLU AUTH)
// Route::get('/scan-redirect/{kode}', function ($kode) {
//     return redirect()->route('scan.process', $kode);
// });

// 3. PROSES HASIL SCAN (DETAIL BARANG)
Route::get('/scan/{kode}', [BarangController::class, 'scan'])
    ->name('scan.process')
    ->where('kode', '.*')
    ->middleware(['auth', 'role:superadmin|timinventarisasi|user']);

// Cetak & Barcode
Route::get('/barang/{barang}/cetak', [BarangController::class, 'cetak'])
    ->name('barang.cetak');

Route::get('/barang/{kode}/barcode', [BarangController::class, 'barcode'])
    ->name('barang.barcode');

// AJAX Routes
Route::get('/get-pic-by-divisi/{divisi}', [PicController::class, 'getByDivisi']);

// Search & Profile
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::post('/profile/update', [ProfileController::class, 'update'])
    ->name('profile.update');