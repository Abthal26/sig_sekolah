<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\SekolahController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index']);



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/kecamatan', [KecamatanController::class, 'index'])->middleware(['auth', 'verified'])->name('kecamatan');

Route::get('/sekolah', [SekolahController::class, 'index'])->middleware(['auth', 'verified'])->name('sekolah');
Route::get('/sekolah/add', [SekolahController::class, 'add'])->middleware(['auth', 'verified']);
Route::get('/sekolah/delete/{id_sekolah}', [SekolahController::class, 'delete'])->middleware(['auth', 'verified']);
Route::get('/sekolah/edit/{id_sekolah}', [SekolahController::class, 'edit'])->middleware(['auth', 'verified']);
Route::post('/sekolah/insert', [SekolahController::class, 'insert'])->middleware(['auth', 'verified']);
Route::post('/sekolah/update/{id_sekolah}', [SekolahController::class, 'update'])->middleware(['auth', 'verified']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
