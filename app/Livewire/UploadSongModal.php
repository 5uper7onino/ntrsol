<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Song;
use getID3;

class UploadSongModal extends Component
{
    use WithFileUploads;

    public $songFile;    // Archivo MP3
    public $title;       // Título de la canción
    public $artist;      // Artista de la canción
    public $album;       // Álbum de la canción
    public $genre;       // Género de la canción
    public $open = false; // Para manejar el estado del modal

    protected $rules = [
        'songFile' => 'required|file|mimes:mp3',
        'title' => 'required|string',
        'artist' => 'required|string',
        'album' => 'required|string',
        'genre' => 'nullable|string',
    ];

    // Este método se ejecuta cuando se selecciona un archivo
    public function updatedSongFile()
    {
        if ($this->songFile) {
            // Crear una instancia de getID3
            $getID3 = new getID3();
            
            // Obtener la ruta temporal del archivo
            $filePath = $this->songFile->getRealPath();

            // Analizar el archivo MP3
            $fileInfo = $getID3->analyze($filePath);
            
            // Extraer los metadatos ID3 si existen
            $this->title = $fileInfo['tags']['id3v2']['title'][0] ?? '';
            $this->artist = $fileInfo['tags']['id3v2']['artist'][0] ?? '';
            $this->album = $fileInfo['tags']['id3v2']['album'][0] ?? '';
            $this->genre = $fileInfo['tags']['id3v2']['genre'][0] ?? '';
        }
    }

    public function save()
    {
        // Validar los datos del formulario
        $this->validate();

        // Subir el archivo MP3
        $path = $this->songFile->store('songs', 'public');

        // Crear la canción en la base de datos
        Song::create([
            'title' => $this->title,
            'artist' => $this->artist,
            'album' => $this->album,
            'genre' => $this->genre,
            'file_path' => $path,
        ]);

        // Limpiar los campos y cerrar el modal
        $this->reset('songFile', 'title', 'artist', 'album', 'genre', 'open');

        // Notificar a otros componentes que se subió una canción
        $this->dispatch('uploadedSong');
    }

    public function render()
    {
        return view('livewire.upload-song-modal');
    }
}
