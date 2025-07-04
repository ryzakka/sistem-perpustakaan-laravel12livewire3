<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('peminjamans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('buku_id')->constrained('bukus');
    $table->foreignId('anggota_id')->constrained('anggotas');
    $table->date('tanggal_pinjam');
    $table->date('tanggal_kembali')->nullable(); // Bisa null saat buku belum dikembalikan
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
