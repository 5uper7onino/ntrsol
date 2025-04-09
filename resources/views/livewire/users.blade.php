<div class="space-y-6">
    <h2 class="text-xl font-bold mb-4">Usuarios</h2>

    <!-- Tabla de Usuarios -->
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Nombre</th>
                <th class="px-4 py-2 text-left">Correo Electrónico</th>
                <th class="px-4 py-2 text-left">Fecha de Registro</th>
                <th class="px-4 py-2 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->created_at->format('d-m-Y') }}</td>
                    <td class="px-4 py-2">
                        <button class="text-blue-500 hover:text-blue-700">
                            Ver
                        </button>
                        <!-- Aquí puedes agregar más botones como Editar o Eliminar -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
