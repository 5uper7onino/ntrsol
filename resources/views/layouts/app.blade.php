<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es" class="h-screen dark">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mi App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        // Ejecuta esto lo más pronto posible (en el <head> idealmente)
        if (localStorage.getItem('theme') === 'dark') {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark');
        }
      </script>
    @livewireStyles
</head>
<body class="bg-gray-50 dark:bg-gray-700 text-gray-800 h-screen flex flex-col">
    {{ $slot }}

    @livewireScripts
</body>
</html>
