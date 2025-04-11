<?php
namespace App\Livewire;

use Livewire\Component;

class Player extends Component
{
    public $playlist = []; // Cola de canciones
    public $currentIndex = 0; // Índice de la canción actual

    protected $listeners = [
        'playSong' => 'playSong',
        'addToQueue' => 'addToQueue',
        'playNext' => 'playNext'
    ];

    public function mount()
    {
        // Canción predeterminada
        $this->playlist = ['/storage/songs/song.mp3'];
        $this->currentIndex = 0;
    }

    public function getCurrentSongProperty()
    {
        return $this->playlist[$this->currentIndex] ?? null;
    }

    public function playSong($path)
    {
        $this->playlist = [$path]; // Reemplaza la cola
        $this->currentIndex = 0;
        $this->dispatch('play-new-song');
    }

    public function addToQueue($path)
    {
        $this->playlist[] = $path;
    }

    public function playNext()
    {
        if ($this->currentIndex + 1 < count($this->playlist)) {
            $this->currentIndex++;
            $this->dispatch('play-new-song');
        }
    }

    public function render()
    {
        return view('livewire.player');
    }
}
