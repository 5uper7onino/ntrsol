<x-modal wire:model="showModal"  maxWidth="7xl">
    <x-slot name="title">
        Registrar Nuevo Paciente
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="register">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Imagen del paciente ocupa 1 de 5 columnas -->
                <div class="row-span-3">
                    <label class="block text-gray-700 dark:text-gray-200 mb-1">Foto del Paciente</label>
                    
                    <!-- Preview / Placeholder que actúa como botón -->
                    <div 
                        class="w-full h-[250px] bg-gray-100 dark:bg-gray-700 border border-dashed rounded-lg cursor-pointer flex items-center justify-center overflow-hidden"
                        onclick="document.getElementById('profile_photo_input').click()"
                    >
                        @if ($profile_photo)
                            <img src="{{ $profile_photo->temporaryUrl() }}" class="object-cover w-full h-full" alt="Preview" />
                        @else
                            <span class="text-gray-400 dark:text-gray-300 text-sm">Haz clic para seleccionar una foto</span>
                        @endif
                    </div>
                
                    <!-- Input oculto -->
                    <input 
                        type="file" 
                        id="profile_photo_input" 
                        wire:model="profile_photo"
                        class="hidden"
                        accept="image/*"
                    />
                
                    @error('profile_photo') 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
                
                
                <div class="mb-4 col-span-1">
                    <label for="name" class="block text-gray-700 dark:text-gray-200">Nombre</label>
                    <input 
                        type="text" 
                        id="name" 
                        wire:model.defer="name"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    />
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                
                <div class="mb-4 col-span-1">
                    <label for="father_name" class="block text-gray-700 dark:text-gray-200">Apellido Paterno</label>
                    <input 
                        type="text" 
                        id="father_name" 
                        wire:model.defer="father_name"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    />
                    @error('father_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-1">
                    <label for="mother_name" class="block text-gray-700 dark:text-gray-200">Apellido Materno</label>
                    <input 
                        type="text" 
                        id="mother_name" 
                        wire:model.defer="mother_name"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    />
                    @error('mother_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-1">
                    <label for="email" class="block text-gray-700 dark:text-gray-200">Correo Electrónico</label>
                    <input 
                        type="email" 
                        id="email" 
                        wire:model.defer="email"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    />
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-1">
                    <label for="dob" class="block text-gray-700 dark:text-gray-200">Fecha de Nacimiento</label>
                    <input 
                        type="date" 
                        id="dob" 
                        wire:model.defer="dob"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    />
                    @error('dob') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-1">
                    <label for="gender" class="block text-gray-700 dark:text-gray-200">Género</label>
                    <select 
                        id="gender" 
                        wire:model.defer="gender"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    >
                        <option value="">Seleccionar...</option>
                        <option value="male">Masculino</option>
                        <option value="female">Femenino</option>
                        <option value="other">Otro</option>
                    </select>
                    @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-1">
                    <label for="phone_number" class="block text-gray-700 dark:text-gray-200">Número de Teléfono</label>
                    <input 
                        type="text" 
                        id="phone_number" 
                        wire:model.defer="phone_number"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    />
                    @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-1">
                    <label for="address" class="block text-gray-700 dark:text-gray-200">Dirección</label>
                    <input 
                        type="text" 
                        id="address" 
                        wire:model.defer="address"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    />
                    @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-1">
                    <label for="occupation" class="block text-gray-700 dark:text-gray-200">Ocupación</label>
                    <select 
                        id="occupation" 
                        wire:model.defer="occupation"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    >
                        <option value="">Seleccionar...</option>
                        <option value="Desempleado">Desempleado</option>
                        <option value="Cuenta Propia">Cuenta Propia</option>
                        <option value="Empleado">Empleado</option>
                    </select>
                    @error('occupation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-1">
                    <label for="marital_status" class="block text-gray-700 dark:text-gray-200">Estado Civil</label>
                    <select 
                        id="marital_status" 
                        wire:model.defer="marital_status"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    >
                        <option value="">Seleccionar...</option>
                        <option value="single">Soltero/a</option>
                        <option value="married">Casado/a</option>
                        <option value="divorced">Divorciado/a</option>
                        <option value="widowed">Viudo/a</option>
                        <option value="widowed">Unión Libre</option>
                    </select>
                    @error('marital_status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-1">
                    <label for="referal_source" class="block text-gray-700 dark:text-gray-200">Como Nos Conoció?</label>
                    <select 
                        id="referal_source" 
                        wire:model.defer="referal_source"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    >
                        <option value="">Seleccfionar...</option>
                        <option value="Amigo">Amigo</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Tik">Tik Tok</option>
                        <option value="Instagram">Instagram</option>
                        <option value="Otro">Otro</option>
                    </select>
                    @error('referal_source') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-1">
                    <label for="emergency_contact" class="block text-gray-700 dark:text-gray-200">Contacto de Emergencia</label>
                    <input 
                        type="text" 
                        id="emergency_contact" 
                        wire:model.defer="emergency_contact"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    />
                    @error('emergency_contact') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-span-2">
                    <label for="medical_history" class="block text-gray-700 dark:text-gray-200">Historia Médica</label>
                    <textarea 
                        id="medical_history" 
                        wire:model.defer="medical_history"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    ></textarea>
                    @error('medical_history') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 col-start-4">
                    <label for="status" class="block text-gray-700 dark:text-gray-200">Estado</label>
                    <select 
                        id="status" 
                        wire:model.defer="status"
                        class="w-full px-4 py-2 border rounded-lg bg-white border-orange-400 focus:outline-none focus:ring-orange-400 focus:border-orange-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    >
                        <option value="active">Activo</option>
                        <option value="inactive">Inactivo</option>
                    </select>
                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                

            </div>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" wire:click="$set('showModal', false)"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
                    Cancelar
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 dark:bg-orange-600 dark:hover:bg-orange-700">
                    Guardar
                </button>
            </div>
        </form>
    </x-slot>
</x-modal>
