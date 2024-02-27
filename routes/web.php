<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DataBukuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\TampilanController;
use App\Http\Controllers\UlasanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PenggunaController::class, 'index'])->name('beranda');
Route::get('/search', [BukuController::class, 'search'])->name('bukus.search');
Route::get('/buku/{id}', [UlasanController::class, 'index'])->name('buku.show');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin,petugas'])->group(function () {
        Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
        // Buku
        Route::get('/dashboard/buku', [BukuController::class, 'index'])->name('bukus.index');
        Route::post('/dashboard/buku', [BukuController::class, 'store'])->name('bukus.store');
        Route::put('/dashboard/buku/{id}', [BukuController::class, 'update'])->name('bukus.update');
        Route::delete('/dashboard/buku/{id}', [BukuController::class, 'destroy'])->name('bukus.destroy');
        Route::get('/dashboard/buku/pdf', [BukuController::class, 'bukuPDF'])->name('bukus.pdf');

        // Kategori
        Route::get('/dashboard/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('/dashboard/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('/dashboard/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/dashboard/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        //Kategori Buku
        Route::get('/dashboard/kategori-buku', [KategoriBukuController::class, 'index'])->name('kategori-buku.index');
        Route::post('/dashboard/kategori-buku', [KategoriBukuController::class, 'store'])->name('kategori-buku.store');
        Route::put('/dashboard/kategori-buku/{id}', [KategoriBukuController::class, 'update'])->name('kategori-buku.update');
        Route::delete('/dashboard/kategori-buku/{id}', [KategoriBukuController::class, 'destroy'])->name('kategori-buku.destroy');

        // Peminjaman
        Route::get('/dashboard/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::put('/dashboard/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
        Route::delete('/dashboard/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
        Route::get('/dashboard/peminjaman/pdf', [PeminjamanController::class, 'peminjamanPDF'])->name('peminjaman.pdf');

        Route::get('/dashboard/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    });

    Route::middleware(['role:petugas'])->group(function () {});
        // Admin
        Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/dashboard/admin', [AdminController::class, 'store'])->name('admin.store');
        Route::put('/dashboard/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/dashboard/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::middleware(['role:user'])->group(function () {
        // Peminjaman
        Route::post('/tampilan/{id}/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        // Ulasan
        Route::post('/tampilan/{id}/ulasan', [TampilanController::class, 'store'])->name('tampilan.store');
        Route::delete('/tampilan/{id}/ulasan', [TampilanController::class, 'destroy'])->name('tampilan.destroy');


        // Koleksi
        Route::get('/koleksi', [KoleksiController::class, 'index'])->name('koleksi.index');
        Route::post('/koleksi', [KoleksiController::class, 'store'])->name('koleksi.store');
        Route::delete('/koleksi/{id}', [KoleksiController::class, 'destroy'])->name('koleksi.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
