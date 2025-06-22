<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;

class BukuManager extends Component
{
    use WithPagination;

    public $judul, $penulis, $tahun_terbit, $kategori_id, $rak_id;
    public $buku_id;
    public $isUpdateMode = false;
    public $search = '';

    protected $rules = [
        'judul' => 'required|string',
        'penulis' => 'required|string',
        'tahun_terbit' => 'required|digits:4|integer|min:1900',
        'kategori_id' => 'required|exists:kategoris,id',
        'rak_id' => 'required|exists:raks,id',
    ];
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    private function resetInputFields()
    {
        $this->judul = '';
        $this->penulis = '';
        $this->tahun_terbit = '';
        $this->kategori_id = '';
        $this->rak_id = '';
        $this->buku_id = null;
        $this->isUpdateMode = false;
    }

    public function store()
    {
        $this->validate();
        Buku::create([
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'tahun_terbit' => $this->tahun_terbit,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
        ]);
        session()->flash('message', 'Buku berhasil ditambahkan.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $this->buku_id = $id;
        $this->judul = $buku->judul;
        $this->penulis = $buku->penulis;
        $this->tahun_terbit = $buku->tahun_terbit;
        $this->kategori_id = $buku->kategori_id;
        $this->rak_id = $buku->rak_id;
        $this->isUpdateMode = true;
    }

    public function update()
    {
        $this->validate();
        $buku = Buku::find($this->buku_id);
        $buku->update([
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'tahun_terbit' => $this->tahun_terbit,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
        ]);

        $this->isUpdateMode = false;
        session()->flash('message', 'Buku berhasil diperbarui.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Buku::find($id)->delete();
        session()->flash('message', 'Buku berhasil dihapus.');
    }

    public function render()
    {
        $bukus = Buku::with(['kategori', 'rak'])
            ->where(function($query) {
                $query->where('judul', 'like', '%'.$this->search.'%')
                      ->orWhere('penulis', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.buku-manager', [
            'bukus' => $bukus,
            'kategoris' => Kategori::all(),
            'raks' => Rak::all()
        ])->layout('layouts.app');
    }
}