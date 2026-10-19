<?php

use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::get('/produk/{slug}', [ProdukController::class, 'show'])->name('produk.detail');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.detail');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('layanan', LayananController::class)->except('show');
    Route::resource('artikel', AdminArtikelController::class)->except('show');
    Route::resource('galeri', AdminGaleriController::class)->except('show');

    Route::get('/cms', [CmsController::class, 'edit'])->name('cms.edit');
    Route::put('/cms', [CmsController::class, 'update'])->name('cms.update');

    Route::get('/pengaturan', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});

require __DIR__.'/auth.php';
