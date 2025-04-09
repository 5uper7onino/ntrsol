<div class="flex flex-col lg:flex-row min-h-screen h-screen">

    <!-- Sidebar (Izquierda) -->
    <aside
        x-data="{ open: false }"
        x-on:toggle-mobile-menu.window="open = !open"
        x-bind:class="{ 'block': open, 'hidden': !open }"
        class="bg-gray-100 dark:bg-gray-900 w-64 p-4 border-r border-gray-200 dark:border-gray-700 lg:block hidden">

        <!-- Logo -->
        <div class="mb-8">
            <img src="{{asset('logos/Rk2.png')}}" alt="Logo" class="w-32 mx-auto">
        </div>

        <!-- Menu -->
        <nav class="space-y-2 text-gray-700 dark:text-gray-200">
            <button wire:click="setPage('home')" class="w-full text-left px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                Inicio
            </button>
            <button wire:click="setPage('users')" class="w-full text-left px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                Usuarios
            </button>
            <button wire:click="setPage('music')" class="w-full text-left px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                Música
            </button>
            <button wire:click="setPage('settings')" class="w-full text-left px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                Configuración
            </button>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col">

        <!-- Header (Superior) -->
        <header class="bg-white dark:bg-gray-800 shadow px-4 py-3 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
            <h1 class="text-lg font-bold capitalize text-gray-800 dark:text-gray-100">{{ $currentPage }}</h1>

            <!-- Hamburger for mobile -->
            <div class="lg:hidden">
                <button x-data x-on:click="$dispatch('toggle-mobile-menu')" class="text-gray-700 dark:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </header>

        <!-- Main Section -->
        <main class="flex-1 p-6 h-full overflow-y-auto bg-gray-50 dark:bg-gray-900">
            @if ($currentPage === 'home')

            @elseif ($currentPage === 'settings')
                @livewire('settings')
            @elseif ($currentPage === 'users')
                @livewire('users')
            @elseif ($currentPage === 'music')
                @livewire('music')
            @endif
        </main>

        <!-- Reproductor Fijo Abajo -->
        <div class="w-full fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700 shadow z-50 px-4 py-3 flex items-center justify-between">
            @livewire('player')
        </div>
    </div>
</div>
