<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        @vite('resources/css/app.css') {{-- si usas Tailwind con Vite --}}
    </head>
    <body class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-4">

        {{-- Mensaje principal --}}
        <div class="text-center text-4xl font-bold mb-6">
            @yield('message')
        </div>

        {{-- Logo SVG centrado y a la mitad del ancho de la pantalla --}}
        <img src="{{ asset('logos/nutrisol30.svg') }}" 
             alt="Logo" 
             class="w-3/4 max-w-md h-auto">

    </body>
</html>
