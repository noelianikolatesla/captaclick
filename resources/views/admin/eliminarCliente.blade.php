
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
    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">Confirmar eliminación</h4>
        </div>

        <div class="card-body">
            <p>¿Estás seguro de que deseas eliminar al siguiente cliente?</p>

            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Nombre:</strong> {{ $cliente->nombre }} {{ $cliente->apellidos }}</li>
                <li class="list-group-item"><strong>Tipo:</strong> {{ ucfirst($cliente->tipo_cliente) }}</li>
                <li class="list-group-item"><strong>NIF/CIF:</strong> {{ $cliente->nif_cif }}</li>
                <li class="list-group-item"><strong>Teléfono:</strong> {{ $cliente->telefono }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $cliente->email }}</li>
                <li class="list-group-item"><strong>Localidad:</strong> {{ $cliente->localidad }}, {{ $cliente->provincia }}</li>
            </ul>

            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="d-flex justify-content-between">
                    <a href="{{ route('clientes.showAdmin') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Botón volver -->
    <div class="mt-4">
        <a href="{{ route('clientes.showAdmin') }}" class="btn btn-secondary">Volver al listado</a>
    </div>
</div>

    </body>
</html>
