<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MinuteController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/notulen', [MinuteController::class, 'index'])->name('dashboard.minute.index');
    Route::get('/notulen/tambah', [MinuteController::class, 'create'])->name('dashboard.minute.create');
    Route::post('/notulen/tambah', [MinuteController::class, 'store'])->name('dashboard.minute.store');
    Route::get('/notulen/{id}/cetak', [MinuteController::class, 'printPDF'])->name('dashboard.minute.printPDF');
    Route::get('/notulen/{id}/ubah', [MinuteController::class, 'edit'])->name('dashboard.minute.edit');
    Route::put('/notulen/{id}/ubah', [MinuteController::class, 'update'])->name('dashboard.minute.update');
    Route::delete('/notulen/{id}/hapus', [MinuteController::class, 'destroy'])->name('dashboard.minute.destroy');
});
