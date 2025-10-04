@props(['label'])
<div class="flex rounded-lg overflow-hidden border dark:border-gray-700">
    <div class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 px-3 py-2 font-semibold w-1/3">
        {{ $label }}
    </div>
    <div class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 px-3 py-2 w-2/3">
        {{ $slot }}
    </div>
</div>
