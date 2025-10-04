@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white', 'dropdownClasses' => ''])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    'none', 'false' => '',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    '60' => 'w-60',
    default => 'w-48',
};
@endphp

<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <!-- Trigger Button -->
    <div @click="open = ! open">
        <button class="w-full text-left px-4 py-2 rounded flex justify-between items-center hover:bg-gray-200 dark:hover:bg-gray-800">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-id-card text-gray-600 dark:text-gray-300 w-5"></i>
                {{$triggerLabel??'<span class="text-gray-800 dark:text-gray-100">Label</span>'}}
            </div>
            <!-- Flecha (Caret) que cambia según si está abierto o cerrado -->
            <i :class="open ? 'fa fa-caret-down' : 'fa fa-caret-right'" class="text-gray-600 dark:text-gray-300"></i>
        </button>
    </div>

    <!-- Dropdown Content -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }} {{ $dropdownClasses }}"
        style="display: none;"
        @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
