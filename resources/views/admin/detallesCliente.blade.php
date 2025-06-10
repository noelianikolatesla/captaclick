<!-- resources/views/clientes/show.blade.php -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles del Cliente</title>

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
    <header>
        @include('app')
    </header>

    <div class="container">
        <h2 class="mb-4">{{ $cliente->nombre }} {{ $cliente->apellidos }}</h2>

        <!-- Datos Básicos -->
        <div class="details-section">
            <h5>Datos Básicos</h5>
            <p><strong>Tipo de cliente:</strong> {{ ucfirst($cliente->tipo_cliente) }}</p>
            <p><strong>NIF/CIF:</strong> {{ $cliente->nif_cif }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Fecha de alta:</strong> {{ \Carbon\Carbon::parse($cliente->fecha_alta)->format('d/m/Y') }}</p>
        </div>

        <!-- Dirección -->
        <div class="details-section">
            <h5>Dirección</h5>
            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
            <p><strong>Código Postal:</strong> {{ $cliente->codigo_postal }}</p>
            <p><strong>Localidad:</strong> {{ $cliente->localidad }} | <strong>Provincia:</strong> {{ $cliente->provincia }}</p>
            <p><strong>País:</strong> {{ $cliente->pais }}</p>
        </div>

        <!-- Datos Bancarios -->
        <div class="details-section">
            <h5>Datos Bancarios</h5>
            <p><strong>IBAN:</strong> {{ $cliente->iban }}</p>
        </div>

        <!-- Observaciones -->
        @if ($cliente->observaciones)
        <div class="details-section">
            <h5>Observaciones</h5>
            <p>{{ $cliente->observaciones }}</p>
        </div>
        @endif

<!-- Botón volver con estilo turquesa personalizado -->
<div class="mt-4 d-flex justify-content-center gap-3">
    <a href="{{ route('admin.inmuebles') }}" class="btn btn-volver">
        Volver al listado
    </a>
</div>
    </div>
</body>
</html>
