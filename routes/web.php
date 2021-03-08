<?php

use App\Http\Controllers\Admin\CetakController;
use App\Http\Controllers\Masyarakat\PengaduanController;
use App\Http\Controllers\Admin\PengaduanController as PengaduanAController;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\Admin\UserManagementController;
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
        Route::prefix('pengaduan')->group(function () {
            Route::get('/', [PengaduanAController::class, 'index'])->name('admin.index');
            Route::get('/{pengaduan:slug}/detail', [PengaduanAController::class, 'show'])->name('pa.detail');
            Route::post('/{pengaduan:slug}/valid', [PengaduanAController::class, 'valid'])->name('pengaduan.valid');
        });

        Route::post('/tanggapan/', [TanggapanController::class, 'store'])->name('tanggapan.store');

        Route::middleware(['role:admin'])->group(function () {
            Route::get('/user-management', [UserManagementController::class, 'index'])->name('userman.index');
            Route::get('/cetak/{pengaduan:slug}', [CetakController::class, 'cetak'])->name('cetak');
        });
    });
});
