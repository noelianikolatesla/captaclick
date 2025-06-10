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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</head>

<body>
    <header>
        @include('app')
    </header>

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">Confirmar eliminación de visita</h4>
            </div>

            <div class="card-body">
                <p>¿Estás seguro de que deseas eliminar la siguiente visita?</p>

                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>Cliente:</strong> {{ $visita->cliente->nombre }}</li>
                    <li class="list-group-item"><strong>Inmueble:</strong> {{ $visita->inmueble->titulo }}</li>
                    <li class="list-group-item"><strong>Fecha:</strong> {{ $visita->fechaVisita }}</li>
                    <li class="list-group-item"><strong>Hora:</strong> {{ $visita->horaVisita }}</li>
                </ul>

                <form action="{{ route('visitas.destroy', $visita->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.visitas') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Botón volver -->
        <div class="mt-4">
            <a href="{{ route('admin.visitas') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</body>
</html>
