
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CaptaClik</title>
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->


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
        @include('nav')


        <div class="container mt-4">
            @include('app')
            <h2>Selecciona un cliente para visitar el inmueble {{ $idInmueble }}</h2>

            @foreach($clientes as $cliente)
            <div class="p-3 mb-3 bg-light text-dark rounded shadow-sm" style="max-width: 1200px;">
                <form method="GET" action="{{ route('visitas.nuevaVisita') }}" class="d-flex justify-content-between align-items-center">
                    <input type="hidden" name="idInmueble" value="{{ $idInmueble }}">
                    <input type="hidden" name="idCliente" value="{{ $cliente->id }}">
                    <span class="fw-semibold">{{ $cliente->nombre }} {{ $cliente->apellidos }}</span>
                    <button type="submit" class="btn btn-success btn-sm">
                        Programar visita
                    </button>
                </form>
            </div>

            @endforeach

        </div>
    </body>

</html>
