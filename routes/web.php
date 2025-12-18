<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\PenilaianLayananController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES (Tanpa auth)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('pages/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/about', [AboutController::class, 'index'])->name('about');

// REGISTER PUBLIK (Bisa diakses semua orang, otomatis jadi petugas)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// AUTHENTICATED ROUTES (Memerlukan login)
Route::middleware(['auth'])->group(function () {
    // Dashboard untuk semua role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ROUTES KHUSUS ADMIN
    Route::middleware(['admin'])->group(function () {
        // Kategori Pengaduan (Hanya admin)
        Route::prefix('kategori')->name('kategori.')->group(function () {
            Route::get('/', [KategoriPengaduanController::class, 'index'])->name('index');
            Route::get('/create', [KategoriPengaduanController::class, 'create'])->name('create');
            Route::post('/store', [KategoriPengaduanController::class, 'store'])->name('store');
            Route::get('/{id}', [KategoriPengaduanController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [KategoriPengaduanController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [KategoriPengaduanController::class, 'update'])->name('update');
            Route::delete('/{id}', [KategoriPengaduanController::class, 'destroy'])->name('destroy');
        });

        // Data Warga (Hanya admin)
        Route::prefix('warga')->name('warga.')->group(function () {
            Route::get('/', [WargaController::class, 'index'])->name('index');
            Route::get('/create', [WargaController::class, 'create'])->name('create');
            Route::post('/store', [WargaController::class, 'store'])->name('store');
            Route::get('/{id}', [WargaController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [WargaController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [WargaController::class, 'update'])->name('update');
            Route::delete('/{id}', [WargaController::class, 'destroy'])->name('destroy');
        });

        // User Management (Hanya admin)
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/{id}', [UserController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        });

        // Penilaian Layanan (Hanya admin)
        Route::prefix('penilaian')->name('penilaian.')->group(function () {
            Route::get('/', [PenilaianLayananController::class, 'index'])->name('index');
            Route::get('/create', [PenilaianLayananController::class, 'create'])->name('create');
            Route::post('/store', [PenilaianLayananController::class, 'store'])->name('store');
            Route::get('/{id}', [PenilaianLayananController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [PenilaianLayananController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [PenilaianLayananController::class, 'update'])->name('update');
            Route::delete('/{id}', [PenilaianLayananController::class, 'destroy'])->name('destroy');
        });
    });

    // ROUTES UNTUK ADMIN DAN PETUGAS
    Route::middleware(['petugas'])->group(function () {
        // Pengaduan (Admin & Petugas)
        Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
            Route::get('/', [PengaduanController::class, 'index'])->name('index');
            Route::get('/create', [PengaduanController::class, 'create'])->name('create');
            Route::post('/store', [PengaduanController::class, 'store'])->name('store');
            Route::get('/{id}', [PengaduanController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [PengaduanController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [PengaduanController::class, 'update'])->name('update');
            // Hanya admin yang bisa hapus
            Route::delete('/{id}', [PengaduanController::class, 'destroy'])
                ->middleware('admin')
                ->name('destroy');
        });

        // Tindak Lanjut (Admin & Petugas)
        Route::prefix('tindak')->name('tindak.')->group(function () {
            Route::get('/', [TindakLanjutController::class, 'index'])->name('index');
            Route::get('/create', [TindakLanjutController::class, 'create'])->name('create');
            Route::post('/store', [TindakLanjutController::class, 'store'])->name('store');
            Route::get('/{id}', [TindakLanjutController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [TindakLanjutController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [TindakLanjutController::class, 'update'])->name('update');
            // Hanya admin yang bisa hapus
            Route::delete('/{id}', [TindakLanjutController::class, 'destroy'])
                ->middleware('admin')
                ->name('destroy');
        });
    });

    // Media routes (Admin & Petugas)
    Route::prefix('media')->name('media.')->middleware(['petugas'])->group(function () {
        Route::delete('/tindak/{id}/{mediaId}', [TindakLanjutController::class, 'deleteMediaFile'])
            ->name('tindak.delete');
        Route::delete('/pengaduan/{id}/{mediaId}', [PengaduanController::class, 'deleteMediaFile'])
            ->name('pengaduan.delete');
    });
});