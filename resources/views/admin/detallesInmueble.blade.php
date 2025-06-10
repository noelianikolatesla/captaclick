<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles del Inmueble</title>

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

<div class="detalle-card">
    <h2 class="detalle-titulo">Detalles del Inmueble</h2>
    <hr class="detalle-hr">

    <div class="detalle-seccion">
        <div class="detalle-estado">
            <span class="badge-disponible">
                {{ $inmueble->disponible ? '✅ Disponible' : '❌ No disponible' }}
            </span>
        </div>
        <p><strong>Operación:</strong> {{ ucfirst($inmueble->tipo_operacion) }}</p>
        <p><strong>Tipo de vivienda:</strong> {{ ucfirst($inmueble->tipo_vivienda) }}</p>
        <p><strong>Zona:</strong> {{ $inmueble->zona }} | <strong>Código Postal:</strong> {{ $inmueble->codigo_postal }}</p>
        <p><strong>Población:</strong> {{ $inmueble->poblacion }} | <strong>Provincia:</strong> {{ $inmueble->provincia }}</p>
    </div>

    <div class="detalle-seccion">
        <h5 class="detalle-subtitulo">Características</h5>
        <hr class="detalle-hr">
        <p><strong>Metros cuadrados:</strong> {{ $inmueble->m2 }} m²</p>
        <p><strong>Precio:</strong> {{ number_format($inmueble->precio, 2) }} €</p>
        <p><strong>Precio/m²:</strong> {{ number_format($inmueble->precio_m2, 2) }} €/m²</p>
        <p><strong>Habitaciones:</strong> {{ $inmueble->habitaciones }} | <strong>Baños:</strong> {{ $inmueble->banos }}</p>
    </div>

    <div class="detalle-seccion">
        <h5 class="detalle-subtitulo">Extras</h5>
        <hr class="detalle-hr">
        <p><strong>Terraza:</strong> {{ $inmueble->terraza ? 'Sí' : 'No' }}</p>
        <p><strong>Garaje:</strong> {{ $inmueble->garaje ? 'Sí' : 'No' }}</p>
        <p><strong>Piscina:</strong> {{ $inmueble->piscina ? 'Sí' : 'No' }}</p>
        <p><strong>Estado:</strong> {{ ucfirst(str_replace('_', ' ', $inmueble->estado)) }}</p>
    </div>

    <div class="detalle-seccion">
        <h5 class="detalle-subtitulo">Descripción</h5>
        <hr class="detalle-hr">
        <p>{{ $inmueble->descripcion }}</p>
    </div>

    <div class="detalle-seccion">
        <h5 class="detalle-subtitulo">Imágenes del Inmueble</h5>
        <hr class="detalle-hr">
        @if($inmueble->imagenPropiedad && count($inmueble->imagenPropiedad))
            <div class="image-container">
                @foreach ($inmueble->imagenPropiedad as $imagen)
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" alt="Imagen del inmueble">
                    </div>
                @endforeach
            </div>
        @else
            <p>No hay imágenes disponibles.</p>
        @endif
    </div>

    <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
        <a href="{{ route('visitas.seleccionarCliente', $inmueble->id) }}" class="btn-detalle btn-visita">
            ✨ Solicitar Visita
        </a>
        <a href="{{ route('admin.inmuebles') }}" class="btn-detalle btn-volver">
            Volver al listado
        </a>
    </div>
</div>

</body>
</html>
