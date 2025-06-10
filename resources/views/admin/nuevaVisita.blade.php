
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
    <h4>Programar Visita</h4>

    <form action="{{ route('visitas.confirmarVisita') }}" method="POST">
        @csrf

        <input type="hidden" name="idInmueble" value="{{ $inmueble->id }}">
        <input type="hidden" name="idCliente" value="{{ $cliente->id }}">

        <div class="mb-3">
            <label class="form-label">Inmueble</label>
            <input type="text" class="form-control" value="{{ $inmueble->titulo }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <input type="text" class="form-control" value="{{ $cliente->nombre }}" disabled>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Fecha de visita</label>
                <input type="date" name="fechaVisita" class="form-control" required>
            </div>
            <div class="col">
                <label class="form-label">Hora</label>
                <input type="time" name="horaVisita" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Visita</button>
        <a href="{{ route('admin.visitas') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

    </body>

</html>
