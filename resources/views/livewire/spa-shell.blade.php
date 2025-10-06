<div class="flex flex-col lg:flex-row min-h-screen h-screen">

    <!-- Sidebar (Izquierda) -->
    <aside
    x-data="{ open: false }"
    x-on:toggle-mobile-menu.window="open = !open"
    x-bind:class="{
        'translate-x-0 z-10': open,
        '-translate-x-full z-0': !open
    }"
    class="fixed lg:static inset-y-0 left-0 w-64 h-screen bg-gray-100 dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:z-auto">


        <!-- Logo -->
        <div class="mb-8">
            <img src="{{asset('logos/nutrisol30.svg')}}" alt="Logo" class="w-32 mx-auto">
        </div>

        <!-- Menu -->
        <nav class="space-y-2 text-gray-700 dark:text-gray-200">
            <li class="h-64 bg-slate-100 dark:bg-gray-600 m-4 p-3 mb-3 rounded-3xl flex flex-col items-center justify-center text-center">
                <img src="{{ asset('images/pic.jpg') }}" alt="Foto de perfil" class="w-32 h-48 rounded-full object-cover mb-2">
                <span class="text font-300">¡Hola {{ Auth::user()->name }}!</span>
            </li>

            <button wire:click="setPage('home')" class="w-full text-left px-4 py-2 rounded flex items-center space-x-2 hover:bg-gray-200 dark:hover:bg-gray-800">
                <i class="fa-solid fa-house text-gray-600 dark:text-gray-300 w-5"></i>
                <span class="text-gray-800 dark:text-gray-100">Inicio</span>
            </button>

            <x-dropdown2 align="right" width="48" contentClasses="py-1 bg-gray-100" dropdownClasses="bg-white">
                <!-- Trigger -->
                <x-slot name="triggerLabel">
                        <span class="text-gray-800 dark:text-gray-100">Registros</span>
                </x-slot>
                <!-- Dropdown Content -->
                <x-slot name="content">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200" onclick="Livewire.dispatch('openRegisterModal')">Primera vez</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200" wire:click="setPage('Pacientes')">En tratamiento</a>
                </x-slot>
            </x-dropdown2>

            <button wire:click="setPage('Agenda')" class="w-full text-left px-4 py-2 rounded flex items-center space-x-2 hover:bg-gray-200 dark:hover:bg-gray-800">
                <i class="fa-solid fa-address-book text-gray-600 dark:text-gray-300 w-5"></i>
                <span class="text-gray-800 dark:text-gray-100">Agenda</span>
            </button>

            <x-dropdown2 align="right" width="48" contentClasses="py-1 bg-gray-100" dropdownClasses="bg-white">
                <!-- Trigger -->
                <x-slot name="triggerLabel">
                        <span class="text-gray-800 dark:text-gray-100">Configuración</span>
                </x-slot>
            
                <!-- Dropdown Content -->
                <x-slot name="content">
                    <a href="#" id="themeToggler" class="block px-4 py-2 text-gray-700 hover:bg-gray-200" onclick="toggleDarkMode(this);">Modo Oscuro</a>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-dropdown-link href="{{ route('logout') }}"
                                 @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
                
            </x-dropdown2>

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
<div 
    key="{{ $currentPage }}"
    x-data="{ show: false }"
    x-init="show = true"
    x-show="show"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    class="transition-all p-4 flex-1 flex flex-col lg:ml-64"
>

    @if ($currentPage === 'home')
        <div class="text-gray-700 dark:text-gray-200">Inicio</div>
        <div id="calendar" wire:ignore></div>

 
    @elseif ($currentPage === 'Agenda')
        @livewire('agenda')
    @elseif ($currentPage === 'Pacientes')
        @livewire('users')
    @elseif ($currentPage === 'music')
        @livewire('music')
    @endif
</div>



        <livewire:register-patient />

    </div>
</div>
<script>
  function toggleDarkMode() {
    const html = document.documentElement;
    const isDark = html.classList.contains('dark');
    let themeBtn = document.querySelector('#themeToggler');
    if (isDark) {
      html.classList.remove('dark');
      localStorage.setItem('theme', 'light');
      themeBtn.innerHTML = "Modo Oscuro";

    } else {
      html.classList.add('dark');
      localStorage.setItem('theme', 'dark');
      themeBtn.innerHTML = "Modo Claro";
    }
    console.log();
  }
            Livewire.on('calendarLoaded', () => {
                initializeCalendar(); // o tu lógica para cargarlo
            });
</script>
