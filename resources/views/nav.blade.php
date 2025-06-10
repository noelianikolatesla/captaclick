<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CaptaClik</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Estilos --> 

        @if (app()->environment('production')) 
        <!-- En producción, carga los estilos desde Firebase --> 
        <link rel="stylesheet" href="https://jet5-ec3cc.web.app/css/app.css"> 
        <script src="https://jet5-ec3cc.web.app/js/app.js"></script>
        @else 
        <!-- En desarrollo, usa los archivos generados por Vite --> 
        @vite(['public/css/app.css', 'public/js/app.js']) 
        @endif 

    </head>
        <body>

        <header class="max-w-[100%] lg:max-w-[100%]">
            <div class="logo">
                {{-- Logo --}}
                <div id="media-valoraciones"></div>
                <!--<canvas id="canvas" width="940" height="80"></canvas>-->
                <h1 id="nombreEmpresa">CaptaClick</h1>
                <h3 id="eslogan">Tu captación al día</h3>
                <img src="{{ asset('imgs/LogoCaptaClick_Trasparente2.png') }}" alt="Logo CaptaClick" class="logo-img"/>
                <!--<script src="{{ asset('js/canvas.js') }}"></script>-->
            </div>

            <!-- Navigation Menu -->
            @if (Route::has('login'))
            <!--<img src="{{ asset('imgs/LogoCapta.png') }}" alt="Logo CaptaClick" />-->

            <!-- Botón hamburguesa solo en móvil -->
<button id="hamburger-btn" class="block md:hidden fixed top-4 right-4 z-[999] text-white text-4xl bg-[#00bcd4] hover:bg-[#0097a7] rounded-md shadow-md px-4 py-2 border-none transition">
    ☰
</button>


            <!-- Menú nav -->
            
<nav id="mobile-menu" class="hidden md:block w-full md:w-auto backdrop-blur-sm bg-white/10 rounded-md border border-white/20">

  <ul class="nav-menu flex flex-col md:flex-row items-center justify-center gap-2 px-4 py-4 text-center md:py-0 md:px-0">

    <li>
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
            <i class="bi bi-house-door-fill"></i> Inicio
        </a>
    </li>
    <li>
        <a href="{{ url('/') }}#what-we-do" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
            <i class="bi bi-lightbulb-fill"></i> Qué Hacemos
        </a>
    </li>
    <li>
        <a href="{{ url('/') }}#casos-exito" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
            <i class="bi bi-people-fill"></i> Casos de Éxito
        </a>
    </li>
    <li>
        <a href="{{ url('/') }}#contact" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
            <i class="bi bi-envelope-fill"></i> Contacto
        </a>
    </li>
    <li class="relative group">
        <a href="#" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
            <i class="bi bi-gift-fill"></i> Gratis
        </a>
        <ul class="absolute left-0 shadow-sm rounded-sm text-black hidden group-hover:block z-50 bg-gray-700">
            <li>
                <a href="{{ url('/') }}#kit-digital" class="flex items-center gap-1 px-2 py-2 hover:bg-[#f1f1f1] text-sm">
                    <i class="bi bi-patch-check-fill text-[#00bcd4] text-xs"></i> Kit Digital
                </a>
            </li>
            <li>
                <a href="{{ url('/') }}#trial" class="flex items-center gap-1 px-2 py-2 hover:bg-[#f1f1f1] text-sm">
                    <i class="bi bi-clock-fill text-[#00bcd4] text-xs"></i> Prueba
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{ url('/') }}#tariffs" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
            <i class="bi bi-currency-euro"></i> Tarifas
        </a>
    </li>



                    @auth
                    <!-- Menu con opciones de usuario -->
                    <li class="flex flex-col sm:flex-row items-center gap-2">
                        <span class="text-white text-center">{{ Auth::user()->name }}</span>
                        <div class="relative">
                            <button id="menu-toggle" class="flex items-center gap-2 px-2 py-1 text-white bg-transparent border rounded-md hover:bg-[#0097a7]">
                                <span>options</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="dropdown-menu" class="absolute right-0 mt-2 shadow-lg rounded-lg text-black hidden bg-secondary">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 hover:bg-[#f1f1f1]">Perfil</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-[#f1f1f1]" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                    @else
                    <li><a href="{{ route('login') }}" class="block px-5 py-1.5 text-white border border-transparent hover:border-[#19140035] rounded-sm">Log in</a></li>
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}" class="block px-5 py-1.5 border text-white hover:border-[#1915014a] rounded-sm">Register</a></li>
                    @endif
                    @endauth
                </ul>

            </nav>
            @endif
        </header>

        @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
        @endif

        @yield('nav')



        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
