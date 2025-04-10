<div x-data="{
    isUploading: false,
    progress: 0
}"
x-on:livewire-upload-start="isUploading = true"
x-on:livewire-upload-finish="isUploading = false"
x-on:livewire-upload-error="isUploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress"
class="space-y-4 h-full w-full"
>

    <!-- Reproductor -->
    <div class="bg-white dark:bg-gray-500 p-4 rounded-lg shadow-md">
        <div class="flex flex-row items-center w-full">
            <!-- Imagen o Carátula de la canción -->
            <img src="/images/album_cover.jpg" alt="Album Cover" class="w-32 h-32 mb-4 rounded-full">
            <div>
            <!-- Título de la canción -->
            <h3 class="text-lg font-semibold text-gray-700 mb-1">0</h3>
            <p class="text-sm text-gray-500">Artista - Álbum</p>
            </div>


            <!-- Reproductor de audio -->
            <audio id="audioPlayer" controls class="mt-2 w-[50%] sticky bottom-0">
                <source src="{{ $song }}" type="audio/mp3">
                Tu navegador no soporta el elemento de audio.
            </audio>
        </div>
    </div>
</div>
<script>
    window.addEventListener('play-new-song', () => {
        const audio = document.getElementById('audioPlayer');
        // Para forzar recarga del source
        audio.load();
        audio.play();
    });
</script>
