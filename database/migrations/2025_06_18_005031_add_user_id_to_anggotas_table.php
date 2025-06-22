<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            // Tambahkan foreign key ke tabel users.
            // Dibuat nullable agar data anggota yang sudah ada tidak error.
            // constrained() akan otomatis mengarah ke id di tabel users.
            // nullOnDelete() artinya jika user dihapus, field ini akan jadi null.
            $table->foreignId('user_id')->after('id')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            // Perintah untuk menghapus foreign key & kolom saat rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};