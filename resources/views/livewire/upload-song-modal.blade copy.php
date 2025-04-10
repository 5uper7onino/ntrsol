<div>
    <button wire:click="$toggle('open')" class="px-4 py-2 bg-blue-600 text-white rounded">
        Subir canción
    </button>

    @if($open)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">Subir nueva canción</h2>

                {{-- Campos del formulario --}}
                <div class="mb-4">
                    <label for="title" class="block">Título</label>
                    <input type="text" wire:model="title" id="title" class="w-full px-3 py-2 border border-gray-300 rounded mt-1" />
                    @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="artist" class="block">Artista</label>
                    <input type="text" wire:model="artist" id="artist" class="w-full px-3 py-2 border border-gray-300 rounded mt-1" />
                    @error('artist') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="album" class="block">Álbum</label>
                    <input type="text" wire:model="album" id="album" class="w-full px-3 py-2 border border-gray-300 rounded mt-1" />
                    @error('album') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="genre" class="block">Género</label>
                    <input type="text" wire:model="genre" id="genre" class="w-full px-3 py-2 border border-gray-300 rounded mt-1" />
                    @error('genre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="songFile" class="block">Archivo MP3</label>
                    <input type="file" wire:model="songFile" id="songFile" accept="audio/mp3" class="w-full px-3 py-2 border border-gray-300 rounded mt-1" />
                    @error('songFile') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="$set('open', false)" class="px-3 py-1 bg-gray-400 text-white rounded">
                        Cancelar
                    </button>
                    <button wire:click="save" class="px-3 py-1 bg-green-600 text-white rounded">
                        Subir
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
