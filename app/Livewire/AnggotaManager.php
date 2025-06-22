<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Anggota;

class AnggotaManager extends Component
{
    use WithPagination;

    public $nama, $nim, $alamat, $no_hp, $anggota_id;
    public $isUpdateMode = false;

    // Definisikan method untuk aturan validasi
    protected function rules()
    {
        return [
            'nama' => 'required|string|min:3',
            'nim' => 'required|string|unique:anggotas,nim,' . $this->anggota_id,
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric',
        ];
    }

    private function resetInputFields()
    {
        $this->nama = '';
        $this->nim = '';
        $this->alamat = '';
        $this->no_hp = '';
        $this->anggota_id = null;
        $this->isUpdateMode = false;
    }

    public function store()
    {
        // Validasi untuk store menggunakan aturan yang lebih ketat
        $this->validate([
            'nama' => 'required|string|min:3',
            'nim' => 'required|string|unique:anggotas,nim',
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric',
        ]);

        Anggota::create([
            'nama' => $this->nama,
            'nim' => $this->nim,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
        ]);
        session()->flash('message', 'Data Anggota berhasil ditambahkan.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $this->anggota_id = $id;
        $this->nama = $anggota->nama;
        $this->nim = $anggota->nim;
        $this->alamat = $anggota->alamat;
        $this->no_hp = $anggota->no_hp;
        $this->isUpdateMode = true;
    }

    public function update()
    {
        // INI BAGIAN YANG DIPERBAIKI
        // Memanggil method rules() secara eksplisit
        $this->validate($this->rules());

        $anggota = Anggota::find($this->anggota_id);
        $anggota->update([
            'nama' => $this->nama,
            'nim' => $this->nim,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
        ]);
        
        $this->isUpdateMode = false;
        session()->flash('message', 'Data Anggota berhasil diperbarui.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Anggota::find($id)->delete();
        session()->flash('message', 'Data Anggota berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.anggota-manager', [
            'anggotas' => Anggota::latest()->paginate(5)
        ])->layout('layouts.app');
    }
}