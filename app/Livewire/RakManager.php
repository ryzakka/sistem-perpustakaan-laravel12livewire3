<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Rak;

class RakManager extends Component
{
    use WithPagination;

    public $kode_rak, $lokasi, $rak_id;
    public $isUpdateMode = false;

    // Definisikan method untuk aturan validasi
    protected function rules()
    {
        // Aturan ini akan mengabaikan pengecekan 'unique' untuk data yang sedang diedit
        return [
            'kode_rak' => 'required|string|unique:raks,kode_rak,' . $this->rak_id,
            'lokasi' => 'required|string|min:3',
        ];
    }
    
    private function resetInputFields()
    {
        $this->kode_rak = '';
        $this->lokasi = '';
        $this->rak_id = null;
        $this->isUpdateMode = false;
    }

    public function store()
    {
        // Validasi untuk store menggunakan aturan yang lebih ketat
        $this->validate([
            'kode_rak' => 'required|string|unique:raks,kode_rak',
            'lokasi' => 'required|string|min:3',
        ]);

        Rak::create([
            'kode_rak' => $this->kode_rak,
            'lokasi' => $this->lokasi,
        ]);
        session()->flash('message', 'Data Rak berhasil ditambahkan.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $rak = Rak::findOrFail($id);
        $this->rak_id = $id;
        $this->kode_rak = $rak->kode_rak;
        $this->lokasi = $rak->lokasi;
        $this->isUpdateMode = true;
    }

    public function update()
    {
        // INI BAGIAN YANG DIPERBAIKI
        // Memanggil method rules() secara eksplisit
        $this->validate($this->rules());

        $rak = Rak::find($this->rak_id);
        $rak->update([
            'kode_rak' => $this->kode_rak,
            'lokasi' => $this->lokasi,
        ]);
        
        $this->isUpdateMode = false;
        session()->flash('message', 'Data Rak berhasil diperbarui.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Rak::find($id)->delete();
        session()->flash('message', 'Data Rak berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.rak-manager', [
            'raks' => Rak::latest()->paginate(5)
        ])->layout('layouts.app');
    }
}