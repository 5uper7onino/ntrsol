<x-modal wire:model="showModal" maxWidth="7xl">
    <x-slot name="title">
        @if ($seccion === 'datos')
        <div>
            <span class="text-gray-500 dark:text-gray-200">Datos Personales de:</span> {{mb_convert_case($patient->name.' '.$patient->father_name.' '.$patient->mother_name, MB_CASE_TITLE, "UTF-8")}}
        </div>
        @elseif ($seccion === 'historia')
            Historia Clínica
        @elseif ($seccion === 'tratamiento')
            Tratamientos
        @endif
    </x-slot>

    <x-slot name="content">
        @if ($seccion === 'datos')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Foto del paciente --}}
            <div class="row-span-4 flex justify-center">
                <img src="{{ asset('storage/'.$patient->profile_photo_path) }}" alt="Foto del paciente" class="w-48 h-48 object-cover rounded shadow">
            </div>

            {{-- Campos con el nuevo componente --}}
            <x-label2 label="Nombre">{{ $patient->name }}</x-label2>
            <x-label2 label="Email">{{ $patient->email }}</x-label2>
            <x-label2 label="Paterno">{{ $patient->father_name }}</x-label2>
            <x-label2 label="Materno">{{ $patient->mother_name }}</x-label2>
            <x-label2 label="Teléfono">{{ $patient->phone_number }}</x-label2>
            <x-label2 label="Dirección">{{ $patient->address }}</x-label2>
            <x-label2 label="Nacimiento">{{ $patient->dob }}</x-label2>
            <x-label2 label="Género">{{ $patient->gender }}</x-label2>
            <x-label2 label="Ocupación">{{ $patient->occupation }}</x-label2>
            <x-label2 label="Estado Civil">{{ $patient->marital_status }}</x-label2>
            <x-label2 label="Referido por">{{ $patient->referal_source }}</x-label2>
            <x-label2 label="Emergencia">{{ $patient->emergency_contact }}</x-label2>
            <div class="md:col-span-2">
                <x-label2 label="Historial médico">{{ $patient->medical_history }}</x-label2>
            </div>
        </div>
        @elseif ($seccion === 'historia')
            <div>
                <p><strong>Diagnosis:</strong> {{ $patient->diagnosis ?? 'Not available' }}</p>
                <p><strong>Medical Notes:</strong> {{ $patient->notes ?? 'Not available' }}</p>
            </div>
        @elseif ($seccion === 'tratamiento')
            <div>
                <p><strong>Treatment:</strong> {{ $patient->treatment ?? 'Not available' }}</p>
                <p><strong>Frequency:</strong> {{ $patient->frequency ?? 'Not available' }}</p>
            </div>
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-button class="bg-orange-500 text-white hover:bg-orange-600" wire:click="cerrarModal">Close</x-button>
    </x-slot>
</x-modal>
