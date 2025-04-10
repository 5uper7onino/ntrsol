<div>
    <button wire:click="$toggle('open')" class="px-4 py-2 bg-blue-600 text-white rounded">
        Subir muchas canciónes
    </button>

    @if($open)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow w-full max-w-md">
                <h2 class="text-lg font-bold mb-4">Subir nueva canción</h2>

                <div class="mb-4">
                    <label for="songFiles" class="block">Archivo MP3</label>
                    <input type="file" wire:model="songFiles" id="songFiles" accept="audio/mp3" class="w-full px-3 py-2 border border-gray-300 rounded mt-1" multiple />
                    @error('songFiles') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="$set('open', false)" class="px-3 py-1 bg-gray-400 text-white rounded">
                        Cancelar
                    </button>
                    <button wire:click="uploadFolder" class="px-3 py-1 bg-green-600 text-white rounded">
                        Subir
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
