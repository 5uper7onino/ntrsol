<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegisterPatient extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $name = '';
    public  $email = '',$father_name='',$mother_name='',$phone_number='',$address='',$dob='',$gender='',
            $occupation='',$marital_status = '',$referal_source='',$medical_history='',$emergency_contact='';


    public $profile_photo; // nueva propiedad
    public $profile_photo_path; 
    protected $listeners = ['openRegisterModal'];

    public function openRegisterModal()
    {
        //$this->resetValidation();
        $this->reset(['name', 'email','father_name','mother_name','phone_number','address','dob','gender','occupation','marital_status','referal_source','medical_history',
                        'emergency_contact','profile_photo']);
        $this->showModal = true;
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'father_name' => 'required',
            'mother_name' => 'required',
            'phone_number' => 'nullable',
            'address' => 'nullable',
            'dob' => 'required',
            'gender' => 'required',
            'occupation' => 'nullable',
            'marital_status' => 'required',
            'referal_source' => 'required',
            'emergency_contact' => 'required',
            'medical_history' => 'required'
        ]);

        $patient = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'occupation' => $this->occupation,
            'marital_status' => $this->marital_status,
            'referal_source' => $this->referal_source,
            'emergency_contact' => $this->emergency_contact,
            'medical_history' => $this->medical_history,
            'password' =>'',
        ]);

        
        if ($this->profile_photo) {
            $path = $this->profile_photo->store("patients/{$patient->id}", 'public');
            $patient->profile_photo_path = $path;
            $patient->save();
        }
        

        $this->showModal = false;
        //$this->reset();
        $this->dispatch('patientRegistered'); // Si necesitas escuchar en otro lado
    }

    public function render()
    {
        return view('livewire.register-patient');
    }
}
