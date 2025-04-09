<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Song;

class Music extends Component
{
    public $songs;

    public function mount()
    {
        $this->songs = Song::all();  // Carga todos los usuarios
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
