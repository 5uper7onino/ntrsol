<div class="space-y-3">

    <!-- Buscador -->
    <div class="flex justify-end">
        <div class="relative w-full max-w-sm">
            <!-- Ícono opcional -->
            <span class="absolute left-3 top-2.5 text-gray-400 dark:text-gray-500">
                <i class="fa fa-search"></i>
            </span>
    
            <!-- Input -->
            <input 
                id="search"
                type="text"
                wire:model="search"
                wire:keyup="$refresh"
                placeholder=" "
                class="peer w-full pl-10 pr-4 pt-3 text-sm border-0 border-b-2 bg-transparent text-gray-900 dark:text-gray-100 
                       border-gray-300 dark:border-gray-600 focus:border-orange-500 dark:focus:border-orange-400 
                       focus:outline-none focus:ring-0 transition-all duration-300"
            />
    
            <!-- Label flotante -->
            <label for="search"
                class="absolute left-10 top-2 text-gray-400 dark:text-gray-500 text-sm transition-all duration-200 pointer-events-none 
                       peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm 
                       peer-focus:top-0 peer-focus:text-xs peer-focus:text-orange-500 dark:peer-focus:text-orange-400">
                Buscar usuarios...
            </label>
        </div>
    </div>
    
    

    <!-- Tabla de Usuarios con bordes redondeados visibles -->
<div class="overflow-hidden rounded-lg border border-orange-300 dark:border-orange-200 shadow-sm">
    <table class="min-w-full bg-white dark:bg-gray-800">
        <thead class="bg-gray-200 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-100">Nombre</th>
                <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-100">Correo Electrónico</th>
                <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-100">Teléfono</th>
                <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-100">Cómo nos Conoció?</th>
                <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-100">Fecha de Registro</th>
                <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-100">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr class="border-t border-gray-200 dark:border-gray-600">
                <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                    <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                    <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $user->phone }}</td>
                    <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $user->referal_source }}</td>
                    <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $user->created_at->format('d-m-Y') }}</td>
                    <td class="px-4 py-2">
                        <select class="text-orange-500 dark:text-orange-400 dark:bg-gray-600 border border-orange-300 rounded px-2 py-1"
                        onchange="Livewire.dispatch('abrirModalPatient', { patientId: {{ $user->id }}, seccion: this.value })">
                            <option value="" disabled selected>Elija una opción</option>
                            <option value="datos">Datos personales</option>
                            <option value="historia">História Clínica</option>
                            <option value="tratamiento">Tratamiento / Mantenimiento</option>
                          
                            <option value="opciones-pago" hidden>Opciones de pago tratamiento</option>
                            <option value="pagos" hidden>Pagos</option>
                            <option value="documentos-personales" hidden>Documentos Personales</option>
                            <option value="documentos-app" hidden>Documentos App</option>
                          </select>
                          
                    </td>
                </tr>
            @empty
            <tr class="border-t border-gray-200 dark:border-gray-600">
                <td class="px-4 py-2 text-gray-800 dark:text-gray-200">no hay registros</td>
                <td class="px-4 py-2 text-gray-800 dark:text-gray-200"> ---------- </td>
                <td class="px-4 py-2 text-gray-800 dark:text-gray-200"> ---------- </td>
                <td class="px-4 py-2 text-gray-800 dark:text-gray-200"> ---------- </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<livewire:patient-modal />
</div>
