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
                <canvas id="canvas" width="940" height="80"></canvas>
                <h1 id="nombreEmpresa">CaptaClick</h1>
                <h3 id="eslogan">Tu captación al día</h3>
                {{-- <img src="{{ asset('imgs/LogoCapta.png') }}" alt="Logo InmoClick" /> --}}
                <script src="{{ asset('js/canvas.js') }}"></script>
            </div>
            <!-- Navigation Menu -->
            @if (Route::has('login'))

<!-- Botón hamburguesa solo en móvil -->
<button id="hamburger-btn" class="block md:hidden fixed top-4 right-4 z-[999] text-white text-4xl bg-[#00bcd4] hover:bg-[#0097a7] rounded-md shadow-md px-4 py-2 border-none transition">
    ☰
</button>



            <!-- Menú nav -->
            
<nav id="mobile-menu" class="hidden md:block w-full md:w-auto backdrop-blur-sm bg-white/20 rounded-md border border-white/20">

<ul class="nav-menu flex flex-col md:flex-row items-center justify-center gap-1 px-4 py-2 md:py-0 md:px-0 text-center">

                    <li>
                        <a href="/" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
                            <i class="bi bi-house-door-fill"></i> Inicio
                        </a>
                    </li>
                    <li>
                        <a href="#what-we-do" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
                            <i class="bi bi-lightbulb-fill"></i> Qué Hacemos
                        </a>
                    </li>
                    <li>
                        <a href="#casos-exito" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
                            <i class="bi bi-people-fill"></i> Casos de Éxito
                        </a>
                    </li>
                    <li>
                        <a href="#contact" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
                            <i class="bi bi-envelope-fill"></i> Contacto
                        </a>
                    </li>
                    <li class="relative group">
                        <a href="#" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
                            <i class="bi bi-gift-fill"></i> Gratis
                        </a>
                        <ul class="absolute left-0 shadow-sm rounded-sm text-black hidden group-hover:block z-50">
                            <li>
                                <a href="#kit-digital" class="flex items-center gap-1 px-2 py-2 hover:bg-[#f1f1f1]">
                                    <i class="bi bi-patch-check-fill text-[#00bcd4] text-xs"></i> Kit Digital
                                </a>
                            </li>
                            <li>
                                <a href="#trial" class="flex items-center gap-1 px-2 py-2 hover:bg-[#f1f1f1]">
                                    <i class="bi bi-clock-fill text-[#00bcd4] text-xs"></i> Prueba
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#tariffs" class="flex items-center gap-2 hover:bg-[#0097a7] px-4 py-2 rounded-md">
                            <i class="bi bi-currency-euro"></i> Tarifas
                        </a>
                    </li>

                    @auth
                    <li>
                        <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-white border rounded-md hover:bg-[#0097a7]">
                            <i class="bi bi-speedometer2"></i> Menú
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('login') }}" class="flex items-center gap-2 px-5 py-1.5 text-white border border-transparent hover:border-[#19140035] rounded-sm">
                            <i class="bi bi-box-arrow-in-right"></i> Log in
                        </a>
                    </li>
                    @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}" class="flex items-center gap-2 px-5 py-1.5 border text-white hover:border-[#1915014a] rounded-sm">
                            <i class="bi bi-person-plus-fill"></i> Register
                        </a>
                    </li>
                    @endif
                    @endauth
                </ul>
            </nav>


            @endif
        </header>


        @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
        @endif


        <!-- Qué Hacemos -->      
        <section id="what-we-do" class="container-fluid py-5 padding-lateral">

            <h2 class="responsive-h2 text-center mb-10 text-[#00bcd4]">
                Llega el primero a las oportunidades de venta
            </h2>



            <!-- Imagen + textos en fila -->
            <div class="flex flex-col lg:flex-row gap-10 items-start mb-16">
                <!-- Imagen más alta -->
                <div class="w-full lg:w-[65%] p-0 lg:pl-0 lg:pr-4">
                    <div class="h-[300px] sm:h-[450px] md:h-[500px] lg:h-[630px] rounded-xl overflow-hidden shadow-xl border border-[#ccc]">
                        <img src="{{ asset('imgs/acuerdoOk.jpg') }}" alt="Imagen Captación Inmobiliaria"
                             class="w-full h-full object-cover" />

                    </div>

                </div>




                <!-- Textos con más espacio entre tarjetas -->
                <div class="w-full lg:w-[35%] flex flex-col justify-between space-y-6 pl-2">
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-[#00bcd4] hover:shadow-xl transition">                        

                        <h3 class="text-lg font-semibold text-[#00bcd4] mb-2"><span class="text-[#00bcd4] text-xl">⚙️</span>Automatiza tu Captación</h3>
                        <p class="text-gray-800 text-xl">
                            Si quieres escalar tu negocio inmobiliario y aumentar tu cartera de propiedades, CaptaClick es la solución que estabas buscando.
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-[#00bcd4] hover:shadow-xl transition">                        
                        <h3 class="text-lg font-semibold text-[#00bcd4] mb-2">    <span class="text-[#00bcd4] text-xl">🤝</span>CaptaClick: Tu Aliado</h3>
                        <p class="text-gray-800 text-xl">
                            La captación de inmuebles de particulares es uno de los mayores retos para cualquier agente inmobiliario.
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-[#00bcd4] hover:shadow-xl transition">      

                        <p class="text-gray-800 text-xl">
                            <span class="text-[#00bcd4] text-xl">🔍</span>
                            Encontrar pisos de propietarios sin intermediarios puede ser agotador si no cuentas con las herramientas adecuadas.
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-[#00bcd4] hover:shadow-xl transition">
                        <h3 class="text-lg font-semibold text-[#00bcd4] mb-2">
                            <span class="text-[#00bcd4] text-xl">🚀</span> Ahorra Tiempo
                        </h3>
                        <p class="text-gray-800 text-xl">
                            Filtra anuncios útiles sin perder horas revisando portales.
                        </p>
                    </div>

                </div>

            </div>

            <!-- Recuadros inferiores iguales y más separados -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-[#00bcd4] hover:shadow-xl transition  p-6 rounded-xl shadow-md h-[180px] flex items-center">
                    <p class="text-gray-800 text-xl">
                        📉 Muchos profesionales recurren a portales para encontrar viviendas, pero esta estrategia puede ser ineficiente.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-[#00bcd4] hover:shadow-xl transition  p-6 rounded-xl shadow-md h-[180px] flex items-center">
                    <p class="text-gray-800 text-xl">
                        ⚡ Aprovecha tecnología avanzada para acelerar tu proceso de captación.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-[#00bcd4] hover:shadow-xl transition p-6 rounded-xl shadow-md h-[180px] flex items-center">
                    <p class="text-gray-800 text-xl">
                        📬 CaptaClick te proporciona leads de particulares en tiempo real y sin esfuerzo.
                    </p>
                </div>
            </div>

        </section>


        <!-- Casos de Éxito -->
        <section id="casos-exito" class="container-fluid py-5 padding-lateral">
            <h2 class="text-center fw-bold mb-5" style="font-size: 2.5rem; color: #00bcd4; text-shadow: 1px 1px 2px rgba(0,0,0,0.05);">
                Casos de Éxito
            </h2>

            <div class="row g-4">
                @foreach ([
                ['zona' => 'Valencia', 'cliente' => 'Inmobiliaria Solmar', 'detalle' => 'Captó 12 propiedades de particulares en solo 3 días usando los filtros avanzados.'],
                ['zona' => 'Madrid', 'cliente' => 'Grupo Hogar Real', 'detalle' => 'Aumentó un 40% su captación mensual gracias a alertas automáticas.'],
                ['zona' => 'Sevilla', 'cliente' => 'Andalucía Inmuebles', 'detalle' => 'Ahorró más de 10 horas semanales al automatizar el seguimiento de anuncios.'],
                ['zona' => 'Barcelona', 'cliente' => 'BCN Propiedades', 'detalle' => 'Recibió más de 25 leads cualificados en su primer mes con CaptaClick.'],
                ['zona' => 'Bilbao', 'cliente' => 'EtxeBerri Gestión', 'detalle' => 'Captó un inmueble exclusivo gracias a la detección temprana de nuevos anuncios.'],
                ['zona' => 'Málaga', 'cliente' => 'SurHome Pro', 'detalle' => 'Transformó su flujo de trabajo al integrar CaptaClick con su CRM.']
                ] as $i => $exito)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3 d-flex justify-content-center align-items-center rounded-circle border border-primary text-primary fw-bold" style="width: 36px; height: 36px;">
                                    {{ $i + 1 }}
                                </div>
                                <h5 class="mb-0 fw-semibold text-primary" style="font-size: 1.25rem;">{{ $exito['cliente'] }}</h5>
                            </div>
                            <p class="text-muted mb-1" style="font-size: 1.1rem;">📍 {{ $exito['zona'] }}</p>
                            <p class="text-dark" style="font-size: 1.25rem;">{{ $exito['detalle'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>



        <!-- Contacto -->
        <section id="contact"  class="container-fluid py-5 padding-lateral">
            <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center">
                <div class="text-center md:text-left px-4">
                    <h2 class="text-4xl font-bold text-[#00bcd4] mb-4">¿Hablamos?</h2>
                    <p class="text-gray-700 text-2xl">
                        ¿Tienes dudas o quieres probar CaptaClick?<br class="hidden md:inline"> Escríbenos o llámanos.
                    </p>
                    <p class="mt-4 text-gray-600 text-xl">
                        <strong>Email:</strong> contacto@captaclick.com<br>
                        <strong>Teléfono:</strong> +34 612 345 678
                    </p>
                </div>
                <div class="flex justify-center px-4">
                    <img src="{{ asset('imgs/contacto.png') }}" alt="Contacto"
                         class="w-full max-w-md rounded-xl shadow-lg animate-fade-in-up" />
                </div>
            </div>
        </section>
        <!-- Kit Digital -->
        <section id="kit-digital" class="container-fluid py-5 padding-lateral">
            <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center">
                <!-- Imagen clicable -->
                <div class="flex justify-center px-4">
                    <a href="{{ route('register') }}">
                        <img src="{{ asset('imgs/kit-digital.jpg') }}" alt="Kit Digital"
                             class="w-full max-w-lg rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" />
                    </a>
                </div>

                <!-- Texto + botón -->
                <div class="text-center md:text-right px-4">
                    <h2 class="text-4xl font-bold text-[#00bcd4] mb-4">
                        <i class="bi bi-patch-check-fill text-[#117782] mr-2"></i>Kit Digital
                    </h2>
                    <p class="text-gray-700 text-2xl">
                        CaptaClick forma parte del programa <strong>Kit Digital</strong>. Obtén nuestra herramienta con ayuda del bono para digitalización de pymes.
                    </p>
                    <!-- Botón estilo brillante con degradado e icono -->
                    <a href="{{ route('register') }}"
                       class="mt-6 inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold text-white bg-[#00bcd4] hover:bg-[#0097a7] shadow-md hover:shadow-xl hover:scale-105 transition-all duration-300">
                        <i class="bi bi-person-plus-fill text-white text-lg"></i>
                        Regístrate
                    </a>

                </div>
            </div>
        </section>

        <!-- Prueba Gratuita -->
        <section id="trial" class="container-fluid py-5 padding-lateral">
            <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center">
                <!-- Texto + botón -->
                <div class="text-center md:text-left px-4">
                    <h2 class="text-4xl font-bold text-[#00bcd4] mb-4">
                        <i class="bi bi-stars text-[#117782] mr-2"></i>Prueba Gratuita
                    </h2>
                    <p class="text-gray-700 text-2xl">
                        Pruébalo gratis durante <strong>14 días</strong> y descubre cómo CaptaClick transforma tu captación inmobiliaria. ¡Sin compromiso!
                    </p>
                    <a href="{{ route('register') }}"
                       class="mt-6 inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold text-white bg-[#00bcd4] hover:bg-[#0097a7] shadow-md hover:shadow-xl hover:scale-105 transition-all duration-300">
                        <i class="bi bi-rocket-takeoff-fill text-white text-lg"></i>
                        Probar gratis
                    </a>

                </div>

                <!-- Imagen clicable -->
                <div class="flex justify-center px-4">
                    <a href="{{ route('register') }}">
                        <img src="{{ asset('imgs/prueba.png') }}" alt="Prueba gratuita"
                             class="w-full max-w-sm rounded-xl shadow-lg hover:scale-105 transition-transform duration-300" />
                    </a>
                </div>
            </div>
        </section>



        <!-- Tarifas -->
        <section id="tariffs" class="container-fluid py-5 padding-lateral">
            <div class="max-w-7xl mx-auto text-center mb-16 px-4">
                <h2 class="text-5xl font-bold text-[#00bcd4] mb-4" style="text-shadow: 2px 2px 5px rgba(0,188,212,0.2);">
                    Nuestras tarifas
                </h2>
                <p class="text-gray-700 text-2xl">Una única tarifa que lo incluye todo</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-7xl mx-auto px-4">
                <!-- PRO -->
                <div class="bg-white border-l-4 border-[#00bcd4] rounded-2xl shadow-xl p-10 flex flex-col items-center hover:shadow-2xl transition">
                    <h3 class="text-2xl font-bold text-[#00bcd4] mb-3">ClickExplora PRO</h3>
                    <p class="text-xl text-[#117782] font-semibold mb-6">Consulta precios</p>
                    <ul class="text-gray-800 text-lg text-left space-y-3 mb-6">
                        <li>✔ Búsquedas: ilimitadas</li>
                        <li>✔ Provincias: ilimitadas</li>
                        <li>✔ Inmuebles: ilimitados</li>
                        <li>✔ Seguimientos: ilimitados</li>
                        <li>✔ Alertas por email</li>
                        <li>✔ Búsqueda de teléfonos: ilimitadas</li>
                        <li>✔ Acceso hasta 10 usuarios</li>
                        <li>✔ Agenda de gestiones y calendario</li>
                        <li>✔ Sincronización con Google Calendar</li>
                        <li>✔ Importación de contactos</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn-welcome mt-auto px-6 py-2 bg-[#00bcd4] text-white font-semibold rounded-md hover:bg-[#0097a7] transition">Contratar</a>
                </div>

                <!-- Estándar -->
                <div class="bg-white border-l-4 border-[#00bcd4] rounded-2xl shadow-xl p-10 flex flex-col items-center hover:shadow-2xl transition">
                    <h3 class="text-2xl font-bold text-[#00bcd4] mb-1">ClickExplora Estándar</h3>
                    <p class="text-base text-[#117782] mb-3">Sin permanencia</p>
                    <div class="text-[#00bcd4] text-6xl font-bold mb-1">€50</div>
                    <p class="text-base text-gray-500 mb-6">/mes</p>
                    <ul class="text-gray-800 text-lg text-left space-y-3 mb-6">
                        <li>✔ Búsquedas: ilimitadas</li>
                        <li>✔ Provincias: ilimitadas</li>
                        <li>✔ Inmuebles: ilimitados</li>
                        <li>✔ Seguimientos: ilimitados</li>
                        <li>✔ Alertas por email</li>
                        <li>✔ Búsqueda de teléfonos: ilimitadas</li>
                        <li>✔ Agenda y calendario</li>
                        <li>✔ Acceso hasta 3 usuarios</li>
                        <li>✔ Posibilidad de editar inmuebles</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn-welcome mt-auto px-6 py-2 bg-[#00bcd4] text-white font-semibold rounded-md hover:bg-[#0097a7] transition">Contratar</a>
                </div>

                <!-- Demo -->
                <div class="bg-white border-l-4 border-[#00bcd4] rounded-2xl shadow-xl p-10 flex flex-col items-center hover:shadow-2xl transition">
                    <h3 class="text-2xl font-bold text-[#00bcd4] mb-3">ClickExplora Demo</h3>
                    <div class="text-[#00bcd4] text-6xl font-bold mb-1">€0</div>
                    <p class="text-base text-[#117782] mb-4">Prueba gratuita</p>
                    <ul class="text-gray-800 text-lg text-left space-y-3 mb-6">
                        <li>✔ Prueba durante 7 días</li>
                        <li>✔ Todas las funcionalidades</li>
                        <li>✔ 1 único usuario</li>
                        <li>✔ Búsquedas: ilimitadas</li>
                        <li>✔ Inmuebles: ilimitados</li>
                        <li>✔ Seguimientos: ilimitados</li>
                        <li>✔ Alertas por email y app</li>
                        <li>✔ Búsqueda de teléfonos: ilimitadas</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn-welcome mt-auto px-6 py-2 bg-[#00bcd4] text-white font-semibold rounded-md hover:bg-[#0097a7] transition">Probar Gratis</a>
                </div>
            </div>
        </section>






        <footer>
            <p>&copy; 2025 CaptaClick | Todos los derechos reservados.</p>
        </footer>



        <!-- asistente -->
        <button id="btnAsistente"
                class="fixed bottom-6 right-6 z-50 w-16 h-16 rounded-full shadow-xl border-2 border-[#00bcd4] overflow-hidden hover:scale-105 transition">
            <img src="{{ asset('imgs/asistente.png') }}" alt="Asistente" class="w-full h-full object-cover" />
        </button>

        <!-- Aside del asistente virtual -->
        <aside id="asistenteVirtual"
               class="z-40 w-64 p-4 bg-white shadow-xl border border-[#00bcd4] rounded-xl hidden transition-opacity duration-300">
            <div class="flex gap-2 items-center">
                <img src="{{ asset('imgs/asistente.png') }}" alt="Asistente"
                     class="w-20 h-20 rounded-full object-cover" />
                <p id="bocadilloTexto" class="text-gray-800 font-medium">
                    ¡Hola! Soy tu asistente virtual. Si quieres escucharme, pulsa sobre el círculo.
                </p>



            </div>
        </aside>

        <!-- Botón de volver arriba -->

        <button id="btnVolverArriba"
                class="fixed bottom-24 right-6 z-50 w-12 h-12 rounded-full bg-[#00bcd4] text-white text-xl shadow-md hover:bg-[#0097a7] transition hidden"
                title="Volver arriba">
            <i class="bi bi-arrow-up-short"></i>
        </button>



        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
