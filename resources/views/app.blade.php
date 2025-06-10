@php
    $active = Request::path();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CaptaClik</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (app()->environment('production')) 
        <link rel="stylesheet" href="https://jet5-ec3cc.web.app/css/app.css"> 
        <script src="https://jet5-ec3cc.web.app/js/app.js"></script>
    @else 
        @vite(['public/css/app.css', 'public/js/app.js']) 
    @endif 
</head>

<body>
    
    
<!-- Botón hamburguesa solo en móvil -->
<button id="hamburger-btn" class="block md:hidden fixed top-4 right-4 z-[999] text-white text-4xl bg-[#00bcd4] hover:bg-[#0097a7] rounded-md shadow-md px-4 py-2 border-none transition">
    ☰
</button>

    <h2 class="text-2xl font-bold text-white mb-6 drop-shadow">
        Menú Principal
    </h2>

               
<nav id="mobile-menu" class="block w-full md:w-auto backdrop-blur-sm bg-white/20 rounded-md border border-white/20">

<ul class="nav-menu flex flex-col md:flex-row items-center justify-center gap-1 px-4 py-2 md:py-0 md:px-0 text-center">
            <li>
                <a href="{{ url('/admin/inmuebles') }}"
                   class="px-3 py-1 rounded-md transition 
                          {{ Request::is('admin/inmuebles') ? 'bg-[#006d7a] text-white' : 'hover:bg-[#0097a7]' }}">
                    🏘️ Inmuebles
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/clientes') }}"
                   class="px-3 py-1 rounded-md transition 
                          {{ Request::is('admin/clientes') ? 'bg-[#006d7a] text-white' : 'hover:bg-[#0097a7]' }}">
                    👥 Clientes
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/visitas') }}"
                   class="px-3 py-1 rounded-md transition 
                          {{ Request::is('admin/visitas') ? 'bg-[#006d7a] text-white' : 'hover:bg-[#0097a7]' }}">
                    🗓️ Visitas
                </a>
            </li>
            <!--
            <li>
                <a href="{{ url('/admin/ventas') }}"
                   class="px-3 py-1 rounded-md transition 
                          {{ Request::is('admin/ventas') ? 'bg-[#006d7a] text-white' : 'hover:bg-[#0097a7]' }}">
                    💼 Facturación
                </a>
            </li>
            -->
        </ul>
    </nav>

    <div class="mt-8 w-full px-4">
        @yield('app')
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
