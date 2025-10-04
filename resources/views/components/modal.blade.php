@props(['id' => null, 'maxWidth' => '2xl'])

@php
    $id = $id ?? md5($attributes->wire('model'));

    $maxWidthClass = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        '6xl' => 'sm:max-w-6xl',
        '7xl' => 'sm:max-w-7xl',
    ][$maxWidth];
@endphp

<div
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-show="show"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    id="{{ $id }}"
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
    style="display: none;"
>
    <!-- Background overlay -->
    <div
        x-show="show"
        class="fixed inset-0 bg-gray-500 dark:bg-gray-900 dark:opacity-80 opacity-75"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    ></div>

    <!-- Modal panel -->
    <div
        x-show="show"
        class="mb-6 bg-white dark:bg-gray-800 dark:text-gray-100 rounded-lg shadow-xl overflow-hidden transform transition-all sm:w-full {{ $maxWidthClass }} sm:mx-auto"
        x-trap.inert.noscroll="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        <!-- Modal Header -->
        @isset($title)
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center text-lg font-medium">
                {{ $title }}
                <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" @click="show = false">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endisset

        <!-- Modal Body -->
        <div class="px-6 py-4">
            {{ $content ?? $slot }}
        </div>
    </div>
</div>
