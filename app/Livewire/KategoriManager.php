<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kategori;

class KategoriManager extends Component
{
    use WithPagination;

    public $nama_kategori, $kategori_id;
    public $isUpdateMode = false;

    protected $rules = [
        'nama_kategori' => 'required|string|min:3',
    ];

    private function resetInputFields()
    {
        $this->nama_kategori = '';
        $this->kategori_id = null;
        $this->isUpdateMode = false;
    }

    public function store()
    {
        $this->validate();
        Kategori::create(['nama_kategori' => $this->nama_kategori]);
        session()->flash('message', 'Kategori berhasil ditambahkan.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        $this->kategori_id = $id;
        $this->nama_kategori = $kategori->nama_kategori;
        $this->isUpdateMode = true;
    }

    public function update()
    {
        $this->validate();
        $kategori = Kategori::find($this->kategori_id);
        $kategori->update(['nama_kategori' => $this->nama_kategori]);
        
        $this->isUpdateMode = false;
        session()->flash('message', 'Kategori berhasil diperbarui.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Kategori::find($id)->delete();
        session()->flash('message', 'Kategori berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.kategori-manager', [
            'kategoris' => Kategori::latest()->get()
        ])->layout('layouts.app');
    }
}