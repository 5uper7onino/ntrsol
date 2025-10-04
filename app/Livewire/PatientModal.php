<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as Patient;

class PatientModal extends Component
{
    public $showModal = false;
    public $seccion = null;
    public $patientId;
    public $patient;

    protected $listeners = ['abrirModalPatient'];

    public function abrirModalPatient($patientId, $seccion)
    {
        $this->patientId = $patientId;
        $this->seccion = $seccion;
        $this->patient = Patient::find($patientId);
        $this->showModal = true;
    }

    public function cerrarModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.patient-modal');
    }
}
