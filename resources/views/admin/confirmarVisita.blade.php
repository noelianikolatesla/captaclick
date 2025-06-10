
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

            <h4>Confirmar Visita</h4>

            <div class="card p-3 mb-3">
                <p><strong>Inmueble:</strong> {{ $inmueble->id }}</p>
                <p><strong>Cliente:</strong> {{ $cliente->id }}</p>
                <p><strong>Fecha:</strong> {{ $datos['fechaVisita'] }}</p>
                <p><strong>Hora:</strong> {{ $datos['horaVisita'] }}</p>
                <p><strong>Observaciones:</strong> {{ $datos['observaciones'] ?? 'Ninguna' }}</p>
            </div>

            <form action="{{ route('visitas.store') }}" method="POST">
                @csrf
                <input type="hidden" name="idInmueble" value="{{ $datos['idInmueble'] }}">
                <input type="hidden" name="idCliente" value="{{ $datos['idCliente'] }}">
                <input type="hidden" name="fechaVisita" value="{{ $datos['fechaVisita'] }}">
                <input type="hidden" name="horaVisita" value="{{ $datos['horaVisita'] }}">
                <input type="hidden" name="observaciones" value="{{ $datos['observaciones'] }}">

                <button type="submit" class="btn btn-success">Confirmar y Guardar</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </body>

</html>
