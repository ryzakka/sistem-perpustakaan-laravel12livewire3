<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kategori') }}
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

                    <form wire:submit.prevent="{{ $isUpdateMode ? 'update' : 'store' }}" class="mb-6">
                        <div class="mb-4">
                            <label for="nama_kategori" class="block font-medium text-sm text-gray-700">Nama Kategori</label>
                            <input type="text" wire:model="nama_kategori" id="nama_kategori" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" placeholder="Masukkan nama kategori">
                            @error('nama_kategori') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            {{ $isUpdateMode ? 'Update Kategori' : 'Simpan Kategori' }}
                        </button>
                        @if($isUpdateMode)
                            <button wire:click="resetInputFields" type="button" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 ml-2">
                                Batal
                            </button>
                        @endif
                    </form>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($kategoris as $kategori)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $kategori->nama_kategori }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="edit({{ $kategori->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                    <button wire:click="delete({{ $kategori->id }})" wire:confirm="Anda yakin ingin menghapus kategori ini?" class="text-red-600 hover:text-red-900 ml-2">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    Belum ada data kategori.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div class="mt-4">
                        {{ $kategoris->links() }}
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>