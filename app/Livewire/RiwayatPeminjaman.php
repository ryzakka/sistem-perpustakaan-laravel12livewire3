<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RiwayatPeminjaman extends Component
{
    use WithPagination;

    public function render()
{
    $peminjamans = null; // Inisialisasi sebagai null

    // Ambil profil anggota yang terhubung dengan user yang sedang login
    $anggota = Auth::user()->anggota;

    // Hanya jalankan query jika user ini memiliki profil anggota
    if ($anggota) {
        $peminjamans = Peminjaman::where('anggota_id', 'like', $anggota->id)
                                ->with('buku') // Eager load relasi buku agar efisien
                                ->latest('tanggal_pinjam')
                                ->paginate(10);
    } else {
        // Jika user tidak punya profil anggota, kita buat objek Paginator kosong.
        // Ini memastikan method ->links() akan selalu ada di file blade.
        // Format: new LengthAwarePaginator(items, total, perPage)
        $peminjamans = new LengthAwarePaginator([], 0, 10);
    }
    
    return view('livewire.riwayat-peminjaman', [
        'peminjamans' => $peminjamans
    ])->layout('layouts.app');
}
}