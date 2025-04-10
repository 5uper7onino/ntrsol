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

    public function uploadFolder()
    {
        foreach ($this->songFiles as $file) {


            $getID3 = new getID3;
            $info = $getID3->analyze($file->getPathname());

            $title = $info['tags']['id3v2']['title'][0] ?? 'Sin título';
            $artist = $info['tags']['id3v2']['artist'][0] ?? 'Desconocido';
            $album = $info['tags']['id3v2']['album'][0] ?? 'Desconocido';
            $genre = $info['tags']['id3v2']['genre'][0] ?? 'Desconocido';
            $file_name = $file->getClientOriginalName();
            $cover = null;

            if (isset($info['id3v2']['APIC'][0])) {
                $coverData = $info['id3v2']['APIC'][0]['data'];
                $mime = $info['id3v2']['APIC'][0]['image_mime'];

                $coverName = uniqid() . '.' . explode('/', $mime)[1];
                Storage::put("covers/$coverName", $coverData);
                $cover = "covers/$coverName";
            }


            $path = $file->store('songs/'.$artist, 'public');

            Song::create([
                'title' => $title,
                'album' => $album,
                'artist' => $artist,
                'genre' => $genre,
                'file_name' => $file_name,
                'file_path' => $path,
                'cover_path' => $cover,
            ]);
            // Notificar a otros componentes que se subió una canción
        $this->dispatch('uploadedSong');
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
