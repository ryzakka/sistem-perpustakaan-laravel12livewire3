import './bootstrap';

// Langkah 1: Import 'Livewire' dan 'Alpine' dari file sumber Livewire di dalam folder vendor.
// Path ini mengarah ke file JavaScript inti dari paket Livewire yang sudah Anda install via Composer.
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm.js';

// Langkah 2 (Opsional): Jika di masa depan Anda butuh plugin Alpine lain,
// daftarkan di sini sebelum Livewire dimulai. Contoh:
// import focus from '@alpinejs/focus'
// Alpine.plugin(focus)

// Langkah 3: Jalankan Livewire. Perintah ini akan secara otomatis
// menginisialisasi Alpine juga, sehingga dropdown dan semua fungsi Livewire
// akan bekerja secara harmonis menggunakan "mesin" yang sama.
Livewire.start();