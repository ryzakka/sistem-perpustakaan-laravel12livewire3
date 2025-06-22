<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Rak extends Model
{
    use HasFactory;
    protected $table = 'raks';
    protected $fillable = ['kode_rak', 'lokasi'];
}
