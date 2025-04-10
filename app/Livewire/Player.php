<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Song;
use getID3;


class Player extends Component
{


    public $song;

    protected $listeners = [
        'playSong' => 'playSong',
    ];

    public function playSong($path){
        $this->song = $path;
        $this->dispatch('play-new-song');
    }

    public function mount()
    {
        // Canción predeterminada, puedes cambiar la ruta al archivo que prefieras
        $this->song = '/storage/songs/song.mp3'; // Ruta de tu canción predeterminada
    }

    public function render()
    {
        return view('livewire.player');
    }
}
