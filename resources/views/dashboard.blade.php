<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CaptaClik</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Estilos --> 
    @if (app()->environment('production')) 
        <link rel="stylesheet" href="https://jet5-ec3cc.web.app/css/app.css"> 
        <script src="https://jet5-ec3cc.web.app/js/app.js"></script>
    @else 
        @vite(['public/css/app.css', 'public/js/app.js']) 
    @endif 
</head>

    <body>

    @include('nav')

    {{-- Menú dinámico según el rol --}}
    <div class="container mt-20">
        @auth
            @if (Auth::user()->role === 'admin')
                <p>admin</p>
                @include('app') {{-- Vista con menú de admin --}}
            @elseif (Auth::user()->role === 'user')
                <p>user</p>
                @include('appUser') {{-- Vista con menú de usuario --}}
            @endif
        @endauth
    </div>

    {{-- Mensaje de bienvenida --}}
 <div class="container mt-6 text-center">
    <h2 class="text-4xl font-bold text-white drop-shadow mb-2">
        👋 ¡Bienvenido/a, {{ Auth::user()->name }}!
    </h2>
    <p class="text-white/80 text-lg drop-shadow">
        Aquí puedes gestionar tus inmuebles, clientes y visitas.
    </p>
</div>


    <footer class="text-center mt-10">
        <p>&copy; 2025 CaptaClick | Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
