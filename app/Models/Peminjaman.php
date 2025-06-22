<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model {
    use HasFactory;
     protected $table = 'peminjamans';
    protected $fillable = ['buku_id', 'anggota_id', 'tanggal_pinjam', 'tanggal_kembali'];
    public function buku() { return $this->belongsTo(Buku::class); }
    public function anggota() { return $this->belongsTo(Anggota::class); }
}
