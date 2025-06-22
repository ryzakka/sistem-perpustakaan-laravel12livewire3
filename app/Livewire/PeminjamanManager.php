<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Carbon\Carbon;

class PeminjamanManager extends Component
{
    use WithPagination;

    public $buku_id, $anggota_id, $tanggal_pinjam;

    protected $rules = [
        'buku_id' => 'required|exists:bukus,id',
        'anggota_id' => 'required|exists:anggotas,id',
        'tanggal_pinjam' => 'required|date',
    ];

    public function resetInputFields()
    {
        $this->buku_id = null;
        $this->anggota_id = null;
        $this->tanggal_pinjam = null;
    }

    public function store()
    {
        $this->validate();

        $pinjamanAktif = Peminjaman::where('anggota_id', $this->anggota_id)
                                    ->whereNull('tanggal_kembali')
                                    ->count();

        if ($pinjamanAktif >= 3) {
            $this->addError('anggota_id', 'Anggota ini sudah mencapai batas maksimal peminjaman (3 buku).');
            return;
        }

        Peminjaman::create([
            'buku_id' => $this->buku_id,
            'anggota_id' => $this->anggota_id,
            'tanggal_pinjam' => $this->tanggal_pinjam,
        ]);

        session()->flash('message', 'Data peminjaman berhasil ditambahkan.');
        $this->resetInputFields();
    }

    public function markAsReturned($id)
    {
        $peminjaman = Peminjaman::find($id);
        if ($peminjaman) {
            $peminjaman->update(['tanggal_kembali' => Carbon::now()]);
            session()->flash('message', 'Buku telah ditandai sebagai dikembalikan.');
        }
    }

    public function render()
    {
        return view('livewire.peminjaman-manager', [
            'peminjamans' => Peminjaman::with(['buku', 'anggota'])->latest()->paginate(10),
            'bukus' => Buku::orderBy('judul')->get(),
            'anggotas' => Anggota::orderBy('nama')->get(),
        ])->layout('layouts.app');
    }
}