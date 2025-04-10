<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Song;
use getID3;

class UploadMultipleFiles extends Component
{

    use WithFileUploads;

    public $open = false; // Para manejar el estado del modal

    public $songFiles = []; // Array para almacenar múltiples archivos
    public $title;       // Título de la canción
    public $artist;      // Artista de la canción
    public $album;       // Álbum de la canción
    public $file_name;   // nombre del archivo
    public $genre;       // Género de la canción

    protected $rules = [
        'songFiles' => 'required|array',
        'songFiles.*' => 'file|mimes:mp3|max:12000', // cada archivo
        'file_name' => 'required|string|unique:songs,file_name',
        'title' => 'required|string',
        'artist' => 'required|string',
        'album' => 'required|string',
        'genre' => 'nullable|string',
    ];

    public function uploadFolder()
    {
        // Validar los archivos primero
        $this->validate([
            'songFiles' => 'required|array',
            'songFiles.*' => 'file|mimes:mp3|max:12000', // cada archivo
        ]);

        $errors = [];

        foreach ($this->songFiles as $file) {
            // Obtener los datos de las etiquetas ID3
            $getID3 = new getID3;
            $info = $getID3->analyze($file->getRealPath());

            // Obtener la metadata de ID3 o valores predeterminados
            $title = $info['tags']['id3v2']['title'][0] ?? 'Sin título';
            $artist = $info['tags']['id3v2']['artist'][0] ?? 'Desconocido';
            $album = $info['tags']['id3v2']['album'][0] ?? 'Desconocido';
            $genre = $info['tags']['id3v2']['genre'][0] ?? 'Desconocido';
            $file_name = $file->getClientOriginalName();

            // Limpiar el nombre del archivo
            $infoFile = pathinfo($file_name);
            $base = preg_replace('/[^A-Za-z0-9_]/', '_', $infoFile['filename']);
            $base = strtolower(preg_replace('/_+/', '_', trim($base, '_')));
            $ext = strtolower($infoFile['extension']);

            $clean_file_name = $base . '.' . $ext;

            // Validar que el file_name no esté repetido en la base de datos
            $validationRules = [
                'file_name' => 'required|string|unique:songs,file_name',
                'title' => 'required|string',
                'artist' => 'required|string',
                'album' => 'required|string',
                'genre' => 'nullable|string',
            ];

            // Validar cada canción de manera individual
            $validator = \Validator::make([
                'file_name' => $clean_file_name,
                'title' => $title,
                'artist' => $artist,
                'album' => $album,
                'genre' => $genre,
            ], $validationRules);

            if ($validator->fails()) {
                // Si falla la validación, guarda los errores para mostrarlos más tarde
                $errors[] = $validator->errors()->all();
                continue; // Saltar este archivo si hay errores
            }

            // Procesar portada si existe
            $cover = null;
            if (isset($info['id3v2']['APIC'][0])) {
                $coverData = $info['id3v2']['APIC'][0]['data'];
                $mime = $info['id3v2']['APIC'][0]['image_mime'];
                $coverName = uniqid() . '.' . explode('/', $mime)[1];
                Storage::disk('public')->put("covers/$coverName", $coverData);
                $cover = "covers/$coverName";
            }

            // Subir el archivo de música
            $path = $file->store("songs/{$artist}", 'public');

            // Crear la canción en la base de datos
            Song::create([
                'title' => $title,
                'album' => $album,
                'artist' => $artist,
                'genre' => $genre,
                'file_name' => $clean_file_name,
                'file_path' => $path,
                'cover_path' => $cover,
            ]);

            // Notificar a otros componentes que se subió una canción
            $this->dispatch('uploadedSong');
        }

        if (count($errors) > 0) {
            // Si hay errores, puedes mostrarlos o retornar un mensaje
            session()->flash('error', 'Algunas canciones no se subieron debido a errores de validación.');
        } else {
            session()->flash('success', 'Canciones subidas correctamente.');
        }

        return response()->json(['success' => true]);
    }

    public function save(){
        dd($this);
    }

    public function render()
    {
        return view('livewire.upload-multiple-files');
    }
}
