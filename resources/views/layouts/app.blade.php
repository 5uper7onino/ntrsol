<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es" class="h-screen dark">
<head>
    <meta charset="UTF-8">
    <title>Mi App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 dark:bg-gray-700 text-gray-800 h-screen flex flex-col">
    {{ $slot }}

    @livewireScripts
</body>
</html>
