<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Peminjaman;
use App\Livewire\Counter;

// Import semua komponen Livewire
use App\Livewire\BukuManager;
use App\Livewire\PeminjamanManager;
use App\Livewire\KategoriManager;
use App\Livewire\RakManager;
use App\Livewire\AnggotaManager;
use App\Livewire\RiwayatPeminjaman;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda bisa mendaftarkan rute web untuk aplikasi Anda. Rute-rute ini
| dimuat oleh RouteServiceProvider dan semuanya akan ditetapkan ke grup
| middleware "web".
|
*/

// Rute Halaman Awal (Publik)
Route::get('/counter', Counter::class);
Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard (Bisa diakses semua pengguna yang sudah login)
Route::get('/dashboard', function () {
    $bukuDipinjam = Peminjaman::whereNull('tanggal_kembali')->count();
    return view('dashboard', ['bukuDipinjam' => $bukuDipinjam]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup Rute untuk semua pengguna yang sudah login (misal: edit profil sendiri)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/riwayat-peminjaman', RiwayatPeminjaman::class)->name('riwayat.index');

});

// === GRUP RUTE KHUSUS ADMIN ===
// Semua rute di sini hanya bisa diakses oleh pengguna dengan role 'admin'.
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Rute Manajemen Data Master
    Route::get('/kategori', KategoriManager::class)->name('kategori.index');
    Route::get('/rak', RakManager::class)->name('rak.index');
    Route::get('/anggota', AnggotaManager::class)->name('anggota.index');

    // Rute Manajemen Transaksi
    Route::get('/buku', BukuManager::class)->name('buku.index');
    Route::get('/peminjaman', PeminjamanManager::class)->name('peminjaman.index');
});


// Memuat semua rute untuk autentikasi (login, register, logout, dll.)
require __DIR__.'/auth.php';