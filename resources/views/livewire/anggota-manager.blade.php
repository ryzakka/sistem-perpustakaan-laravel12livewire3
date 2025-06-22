<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Anggota') }}
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
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <label for="nama" class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                                    <input type="text" wire:model="nama" id="nama" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                    @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="nim" class="block font-medium text-sm text-gray-700">NIM / No. Induk</label>
                                    <input type="text" wire:model="nim" id="nim" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                    @error('nim') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="no_hp" class="block font-medium text-sm text-gray-700">No. HP</label>
                                    <input type="text" wire:model="no_hp" id="no_hp" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                    @error('no_hp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mb-4">
                                    <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
                                    <textarea wire:model="alamat" id="alamat" rows="6" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
                                    @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ $isUpdateMode ? 'Update Anggota' : 'Simpan Anggota' }}
                            </button>
                             @if($isUpdateMode)
                                <button wire:click="resetInputFields" type="button" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 ml-2">
                                    Batal
                                </button>
                            @endif
                        </div>
                    </form>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIM</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($anggotas as $anggota)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $anggota->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $anggota->nim }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $anggota->no_hp }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="edit({{ $anggota->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                    <button wire:click="delete({{ $anggota->id }})" wire:confirm="Anda yakin ingin menghapus data anggota ini?" class="text-red-600 hover:text-red-900 ml-2">Hapus</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    Belum ada data anggota.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $anggotas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>