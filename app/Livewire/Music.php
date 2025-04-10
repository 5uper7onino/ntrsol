<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Song;

class Music extends Component
{
    public $songs;
    
    protected $listeners = [
        "uploadedSong" => "mount",
    ];

    public function mount()
    {
        $this->loadSongs();  // Carga todos los usuarios
    }

    public function loadSongs(){
        $this->songs = Song::all();
    }

    public function play($path)
    {
        $fullPath = '/storage/' . $path;
        $this->dispatch('playSong', $fullPath);
    }

    public function render()
    {
        return view('livewire.music');
    }
}
