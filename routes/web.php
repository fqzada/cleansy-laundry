<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KasirDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Rute Otomatis Pembagi Jalur setelah Login Sukses
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('kasir.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// KELOMPOK RUTE KHUSUS ADMIN (OWNER)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Rute Halaman 8 (Dashboard Analitik)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Rute Halaman 9 (Konfigurasi Aturan) -> INI YANG TADI HILANG/BELUM DI-SAVE
    Route::get('/settings', [AdminDashboardController::class, 'settings'])->name('admin.settings');

    Route::get('/audit', [App\Http\Controllers\AdminDashboardController::class, 'audit'])->name('admin.audit');
    
}); 

// Rute Halaman 9 (Konfigurasi Aturan)
    Route::get('/settings', [AdminDashboardController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminDashboardController::class, 'updateSettings'])->name('admin.settings.update'); // <-- RUTE BARU

// KELOMPOK RUTE KHUSUS KASIR (KARYAWAN)
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', [KasirDashboardController::class, 'index'])->name('dashboard');
    Route::post('/order', [KasirDashboardController::class, 'store'])->name('order.store'); 
    Route::get('/riwayat', [KasirDashboardController::class, 'riwayat'])->name('riwayat');
    Route::post('/order/{id}/ambil', [KasirDashboardController::class, 'ambil'])->name('order.ambil');
    Route::get('/laporan', [KasirDashboardController::class, 'laporan'])->name('laporan');
    Route::post('/shift/start', [KasirDashboardController::class, 'startShift'])->name('shift.start');
    Route::post('/shift/end', [KasirDashboardController::class, 'endShift'])->name('shift.end');
});

// Rute Bawaan Profile (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';