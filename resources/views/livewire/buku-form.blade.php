<form wire:submit.prevent="{{ $isUpdateMode ? 'update' : 'store' }}" class="mb-6 border-b pb-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <div class="mb-4">
                <label for="judul" class="block font-medium text-sm text-gray-700">Judul Buku</label>
                <input type="text" wire:model.lazy="judul" id="judul" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                @error('judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="penulis" class="block font-medium text-sm text-gray-700">Penulis</label>
                <input type="text" wire:model.lazy="penulis" id="penulis" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                @error('penulis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="tahun_terbit" class="block font-medium text-sm text-gray-700">Tahun Terbit</label>
                <input type="number" wire:model.lazy="tahun_terbit" id="tahun_terbit" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                @error('tahun_terbit') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div>
            <div class="mb-4">
                <label for="kategori_id" class="block font-medium text-sm text-gray-700">Kategori</label>
                <select wire:model="kategori_id" id="kategori_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $category)
                        <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                    @endforeach
                </select>
                @error('kategori_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="rak_id" class="block font-medium text-sm text-gray-700">Rak</label>
                <select wire:model="rak_id" id="rak_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Pilih Rak</option>
                    @foreach($raks as $rak)
                        <option value="{{ $rak->id }}">{{ $rak->kode_rak }} - {{ $rak->lokasi }}</option>
                    @endforeach
                </select>
                @error('rak_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="mt-4">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            {{ $isUpdateMode ? 'Update Buku' : 'Simpan Buku' }}
        </button>
        @if($isUpdateMode)
            <button wire:click="resetInputFields" type="button" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 ml-2">
                Batal
            </button>
        @endif
    </div>
</form>