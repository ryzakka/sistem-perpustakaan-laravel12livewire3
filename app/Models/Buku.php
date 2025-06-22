<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model {
    use HasFactory;
     protected $table = 'bukus';
    protected $fillable = ['judul', 'penulis', 'tahun_terbit', 'kategori_id', 'rak_id'];
    public function kategori() { return $this->belongsTo(Kategori::class); }
    public function rak() { return $this->belongsTo(Rak::class); }
}
