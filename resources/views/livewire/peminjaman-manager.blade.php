<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Form Peminjaman Baru</h3>
                    <form wire:submit.prevent="store">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="buku_id" class="block font-medium text-sm text-gray-700">Buku</label>
                                <select wire:model="buku_id" id="buku_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Pilih Buku</option>
                                    @foreach($bukus as $buku)
                                        <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                                    @endforeach
                                </select>
                                @error('buku_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="anggota_id" class="block font-medium text-sm text-gray-700">Anggota</label>
                                <select wire:model="anggota_id" id="anggota_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Pilih Anggota</option>
                                    @foreach($anggotas as $anggota)
                                        <option value="{{ $anggota->id }}">{{ $anggota->nama }} ({{$anggota->nim}})</option>
                                    @endforeach
                                </select>
                                @error('anggota_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="tanggal_pinjam" class="block font-medium text-sm text-gray-700">Tanggal Pinjam</label>
                                <input type="date" wire:model="tanggal_pinjam" id="tanggal_pinjam" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                @error('tanggal_pinjam') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Simpan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Daftar Peminjaman</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Buku</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Pinjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($peminjamans as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->buku->judul }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->anggota->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->tanggal_kembali)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Dikembalikan ({{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }})
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Dipinjam
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(!$item->tanggal_kembali)
                                    <button wire:click="markAsReturned({{ $item->id }})" wire:confirm="Anda yakin ingin menandai buku ini sudah dikembalikan?" class="text-blue-600 hover:text-blue-900">
                                        Kembalikan
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    Belum ada data peminjaman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                     <div class="mt-4">
                        {{ $peminjamans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>