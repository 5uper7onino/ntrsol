<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Song;
use getID3;


class Player extends Component
{
    use WithFileUploads;


    public $song;
    public $uploadProgress = 0;

    protected $listeners = [
        'uploadProgress' => 'setUploadProgress',
        'playSong' => 'playSong',
    ];

    public function playSong($path){
        $this->song = $path;
        $this->dispatch('play-new-song');
    }

    public function setUploadProgress($progress)
    {
        $this->uploadProgress = $progress;
    }

    public function mount()
    {
        // Canción predeterminada, puedes cambiar la ruta al archivo que prefieras
        $this->song = '/storage/songs/song.mp3'; // Ruta de tu canción predeterminada
    }

    // Método para manejar la carga de nuevos archivos de música
    public function uploadSong()
    {
        $this->validate([
            'song' => 'required|mimes:mp3,wav|max:10240',  // max 10MB
        ]);

        $path = $this->song->store('songs', 'public');  // Guardamos el archivo en la carpeta 'songs'
        $fullPath = storage_path('app/public/' . $path);
        $this->song = '/storage/' . $path;  // Ruta de la canción subida

            // Analizar los metadatos con getID3
        $getID3 = new getID3;
        $fileInfo = $getID3->analyze($fullPath);

        // Asegurarse de que esté parseado
        \getid3_lib::CopyTagsToComments($fileInfo);
        // Extraer info básica si está disponible
        $title = $fileInfo['comments']['title'][0] ?? 'Desconocido';
        $artist = $fileInfo['comments']['artist'][0] ?? 'Desconocido';
        $album = $fileInfo['comments']['album'][0] ?? 'Desconocido';
        $duration = $fileInfo['playtime_seconds'] ?? null;

        new Song([
            'title' => $title,
            'artist' => $artist,
            'album' => $album,
            'genre' => $fileInfo['comments']['genre'][0] ?? 'Desconocido',
            'file_path' => $path,
        ])->save();

        //dd($title, $artist, $album, $duration); // Para depuración, puedes eliminarlo después
    }

    public function render()
    {
        return view('livewire.player');
    }
}
