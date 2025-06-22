<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tes Komponen Livewire
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="text-align: center;">
                    
                    <h1 style="font-size: 4rem;">{{ $count }}</h1>
                    
                    <button wire:click="increment" style="padding: 1rem 2rem; font-size: 1.5rem; background-color: #1f2937; color: white; border: none; cursor: pointer;">
                        +
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>