<div class="overflow-x-auto rounded-lg shadow-md">
    <livewire:upload-song-modal />
    <table class="min-w-full bg-white dark:bg-gray-800 text-sm text-left text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700">
        <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase text-gray-600 dark:text-gray-300">
            <tr>
                <th scope="col" class="px-6 py-3">🎤 Artista</th>
                <th scope="col" class="px-6 py-3">🎶 Título</th>
                <th scope="col" class="px-6 py-3">💿 Álbum</th>
                <th scope="col" class="px-6 py-3">🎧 Género</th>
                <th scope="col" class="px-6 py-3 text-center">Acción</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($songs as $song)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                    <td class="px-6 py-4 font-medium">{{ $song->artist }}</td>
                    <td class="px-6 py-4">{{ $song->title }}</td>
                    <td class="px-6 py-4">{{ $song->album }}</td>
                    <td class="px-6 py-4">{{ $song->genre }}</td>
                    <td class="px-6 py-4 text-center">
                        <button
                            wire:click="play('{{ $song->file_path }}')"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold rounded-md transition duration-300">
                            ▶️ Reproducir
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        No hay canciones disponibles
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
