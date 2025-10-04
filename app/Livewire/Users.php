<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public string $search = '';
    public bool $showModal = false; // Controlar la visibilidad del modal
    public string $name = '';
    public string $email = '';

    // Lógica para registrar un nuevo paciente
    public function registerPatient()
    {
        // Validación
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Crear el nuevo paciente
        User::create([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Cerrar el modal y limpiar los campos
        $this->showModal = false;
        $this->name = '';
        $this->email = '';

        // Refrescar la lista de pacientes (opcional)
        $this->emit('userCreated');
    }

    public function render()
    {
        
        return view('livewire.users', [
            'users' => User::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }
}
