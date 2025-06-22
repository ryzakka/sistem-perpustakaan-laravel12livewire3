<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anggota extends Model {
    use HasFactory;
    protected $table = 'anggotas';
    protected $fillable = ['user_id','nama', 'nim', 'alamat', 'no_hp'];
    public function peminjaman() { return $this->hasMany(Peminjaman::class); }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}