<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');



// Kategori Pengaduan
Route::middleware(['auth'])->group(function () {
    Route::get('/kategori', [KategoriPengaduanController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriPengaduanController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriPengaduanController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriPengaduanController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriPengaduanController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriPengaduanController::class, 'destroy'])->name('kategori.destroy');
});

Route::prefix('kategori')->name('kategori.')->group(function () {
    Route::get('/', [KategoriPengaduanController::class, 'index'])->name('index');
    Route::get('/create', [KategoriPengaduanController::class, 'create'])->name('create');
    Route::post('/store', [KategoriPengaduanController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [KategoriPengaduanController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [KategoriPengaduanController::class, 'update'])->name('update');
    Route::delete('/{id}', [KategoriPengaduanController::class, 'destroy'])->name('destroy');
});

Route::prefix('tindak')->name('tindak.')->group(function () {
    Route::get('/', [TindakLanjutController::class, 'index'])->name('index');
    Route::get('/create', [TindakLanjutController::class, 'create'])->name('create');
    Route::post('/store', [TindakLanjutController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [TindakLanjutController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [TindakLanjutController::class, 'update'])->name('update');
    Route::delete('/{id}', [TindakLanjutController::class, 'destroy'])->name('destroy');
});

Route::resource('pengaduan', PengaduanController::class);
Route::resource('tindak', TindakLanjutController::class);