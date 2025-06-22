<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session()->has('message'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('message') }}</span>
                        </div>
                    @endif

                    {{-- Form Tambah & Update Buku --}}
                    @include('livewire.buku-form')

                    {{-- Fitur Pencarian --}}
                    <div class="mb-4">
                        <input 
                            type="text" 
                            wire:model.live.debounce.300ms="search" 
                            placeholder="Cari berdasarkan judul atau penulis..."
                            class="block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Tabel Data Buku --}}
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Penulis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi Rak</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bukus as $buku)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $buku->judul }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $buku->penulis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $buku->kategori->nama_kategori }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $buku->rak->lokasi }} ({{ $buku->rak->kode_rak }})</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="edit({{ $buku->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                    <button wire:click="delete({{ $buku->id }})" wire:confirm="Anda yakin ingin menghapus buku ini?" class="text-red-600 hover:text-red-900 ml-2">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    Tidak ada data buku ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $bukus->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>