<?php

use App\Http\Controllers\Masyarakat\PengaduanController;
use App\Http\Controllers\Admin\PengaduanController as PengaduanAController;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\MasyarkatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::middleware('role:masyarakat')->prefix('masyarakat')->group(function () {
        Route::get('', [MasyarkatController::class, 'index'])->name('masyarakat.index');
        Route::resource('pengaduan', PengaduanController::class)->parameters([
            'pengaduan' => 'pengaduan:slug'
        ]);
    });

    Route::middleware(['role:admin|petugas'])->prefix('admin')->group(function () {
        Route::get('/', [PengaduanAController::class, 'index'])->name('admin.index');
        Route::get('/{pengaduan:slug}', [PengaduanAController::class, 'show'])->name('pa.detail');
        Route::post('/{pengaduan:slug}/valid', [PengaduanAController::class, 'valid'])->name('pengaduan.valid');

        Route::post('/tanggapan/', [TanggapanController::class, 'store'])->name('tanggapan.store');
    });
});
