<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all();  // Carga todos los usuarios
    }

    public function render()
    {
        return view('livewire.users');  // La vista asociada al componente
    }
}
