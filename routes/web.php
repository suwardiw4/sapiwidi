<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\SapiController;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;
/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama otomatis mengarah ke halaman login
Route::get('/', [AuthController::class, 'login']);

// --- AREA TAMU (HANYA BISA DIAKSES JIKA BELUM LOGIN) ---
Route::middleware('guest')->group(function () {
    // Menampilkan halaman login & Proses mencocokkan data login
    Route::match(['get', 'post'], '/login', [AuthController::class, 'authenticate'])->name('login');
});

// --- AREA PROKSI (WAJIB LOGIN & MEMILIKI ROLE SUPERADMIN / ADMIN) ---
// Menggunakan alias 'auth' yang memanggil \App\Http\Middleware\Auth::class dari bootstrap/app.php
Route::middleware('auth:SuperAdmin,Admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // // Proses Keluar Aplikasi
    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // // 2. Rute Pendamping (Untuk menangkap jika ada yang iseng mengetik /logout di URL browser)
    // Route::get('/logout', function () {
    //     return redirect('/dashboard'); // atau redirect('/login') sesuai keinginan Anda
    // });

    // Mengizinkan rute /logout menerima request GET (dari URL) maupun POST (dari tombol form)
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

    // Manajemen Sapi
    Route::get('/sapi', [SapiController::class, 'index'])->name('sapi.index');
    Route::get('/sapi/create', [SapiController::class, 'create'])->name('sapi.create');
    Route::post('/sapi', [SapiController::class, 'store'])->name('sapi.store');
    Route::get('/sapi/{sapi}/edit', [SapiController::class, 'edit'])->name('sapi.edit');
    Route::put('/sapi/{sapi}/update', [SapiController::class, 'update'])->name('sapi.update');
    Route::delete('/sapi/{sapi}/destroy', [SapiController::class, 'destroy'])->name('sapi.destroy');

    // Manajemen Pesanan / Booking
    Route::get('/sapi/{sapi}/booking', [PesananController::class, 'create'])->name('pesanan.create');
    Route::post('/sapi/{sapi}/booking', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::delete('/pesanan/{pesanan}', [PesananController::class, 'destroy'])->name('pesanan.destroy');

    Route::get('/pesanan/{pesanan}/pembayaran', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pesanan/{pesanan}/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pesanan/{pesanan}/invoice', [PembayaranController::class, 'invoice'])->name('pembayaran.invoice');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

});
