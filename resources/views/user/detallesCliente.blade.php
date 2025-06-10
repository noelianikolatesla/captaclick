<!-- resources/views/clientes/show.blade.php -->
<!DOCTYPE html>
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
    @include('appUser')
</header>

<div class="detalle-card">
    <h2 class="detalle-titulo">Detalles del Cliente</h2><br>

    <div class="detalle-seccion">
        <hr class="detalle-hr">
        <h5 class="detalle-subtitulo">Datos Básicos</h5>
        <p><strong>Nombre:</strong> {{ $cliente->nombre }} {{ $cliente->apellidos }}</p>
        <p><strong>Tipo de cliente:</strong> {{ ucfirst($cliente->tipo_cliente) }}</p>
        <p><strong>NIF/CIF:</strong> {{ $cliente->nif_cif }}</p>
        <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
        <p><strong>Email:</strong> {{ $cliente->email }}</p>
        <p><strong>Fecha de alta:</strong> {{ \Carbon\Carbon::parse($cliente->fecha_alta)->format('d/m/Y') }}</p>
    </div>

    <div class="detalle-seccion">
        <hr class="detalle-hr">
        <h5 class="detalle-subtitulo">Dirección</h5>
        <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
        <p><strong>Código Postal:</strong> {{ $cliente->codigo_postal }}</p>
        <p><strong>Localidad:</strong> {{ $cliente->localidad }} | <strong>Provincia:</strong> {{ $cliente->provincia }}</p>
        <p><strong>País:</strong> {{ $cliente->pais }}</p>
    </div>

    <div class="detalle-seccion">
        <hr class="detalle-hr">
        <h5 class="detalle-subtitulo">Datos Bancarios</h5>
        <p><strong>IBAN:</strong> {{ $cliente->iban }}</p>
    </div>

    @if ($cliente->observaciones)
    <div class="detalle-seccion">
        <hr class="detalle-hr">
        <h5 class="detalle-subtitulo">Observaciones</h5>
        <p>{{ $cliente->observaciones }}</p>
    </div>
    @endif

    <div class="flex flex-wrap justify-center gap-4 mt-6">
        <a href="{{ route('user.clientes') }}" class="btn-detalle btn-volver">
            Volver al listado
        </a>
    </div>
</div>

</body>
</html>
