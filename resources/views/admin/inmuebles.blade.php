<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CaptaClik</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (app()->environment('production'))
        <link rel="stylesheet" href="https://jet5-ec3cc.web.app/css/app.css">
        <script src="https://jet5-ec3cc.web.app/js/app.js"></script>
    @else
        @vite(['public/css/app.css', 'public/js/app.js'])
    @endif

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('nav')

    <div class="container mt-4">
        @include('app')

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-2">
            <h2 class="mb-0">Inmuebles Disponibles Administrador</h2>
            <a href="{{ route('inmuebles.create') }}" class="btn btn-success d-flex align-items-center gap-2 px-3 py-2">
                <span class="d-none d-sm-inline">+ Nuevo Inmueble</span>
                <span class="d-sm-none">+</span>
            </a>
        </div>

        <!-- Filtros -->
        <form method="GET" action="{{ route('admin.inmuebles') }}" class="row g-3 align-items-end mb-4">
            <div class="col-md-2">
                <label for="poblacion" class="form-label">Población</label>
                <select name="poblacion" id="poblacion" class="form-select rounded shadow-sm">
                    <option value="">-- Todas --</option>
                    @foreach($poblaciones as $poblacion)
                        <option value="{{ $poblacion }}" {{ request('poblacion') == $poblacion ? 'selected' : '' }}>
                            {{ $poblacion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="zona" class="form-label d-flex align-items-center">
                    Zona
                    <span class="ms-2 text-info" data-bs-toggle="tooltip" title="Puedes escribir una parte del nombre, por ejemplo: 'norte', 'centro', etc.">
                        <i class="bi bi-question-circle-fill"></i>
                    </span>
                </label>
                <input type="text" name="zona" id="zona" class="form-control" value="{{ request('zona') }}" placeholder="Ej: norte, centro">
            </div>

            <div class="col-md-2">
                <input type="number" name="precio_max" class="form-control" placeholder="Precio máximo (€)" value="{{ request('precio_max') }}">
            </div>

            <div class="col-md-2">
                <label for="tipo_operacion" class="form-label">Operación</label>
                <select name="tipo_operacion" id="tipo_operacion" class="form-select rounded shadow-sm">
                    <option value="">--</option>
                    <option value="venta" {{ request('tipo_operacion') == 'venta' ? 'selected' : '' }}>Venta</option>
                    <option value="alquiler" {{ request('tipo_operacion') == 'alquiler' ? 'selected' : '' }}>Alquiler</option>
                    <option value="traspaso" {{ request('tipo_operacion') == 'traspaso' ? 'selected' : '' }}>Traspaso</option>
                </select>
            </div>

            <div class="col-md-1 form-check d-flex align-items-center">
                <input type="checkbox" name="disponible" class="form-check-input me-1" value="1" {{ request('disponible') == '1' ? 'checked' : '' }}>
                <label class="form-check-label">Disponible</label>
            </div>

            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                <a href="{{ route('admin.inmuebles') }}" class="btn btn-secondary w-100">Limpiar</a>
            </div>
        </form>

        <!-- Inmuebles -->
        <div class="row justify-content-center">
            @foreach($inmuebles as $inmueble)
                <div class="col-12 col-md-10 col-lg-4 mb-4">
                    <div class="card h-100 d-flex flex-column">
                        @if ($inmueble->imagenPropiedad->isNotEmpty())
                            <div class="carousel slide" id="carousel-{{ $inmueble->id }}" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($inmueble->imagenPropiedad as $index => $imagen)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" class="card-img-top" alt="Imagen del inmueble">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $inmueble->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $inmueble->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>
                        @else
                            <img src="https://via.placeholder.com/300" class="card-img-top" alt="Fallo en Imagen del inmueble">
                        @endif

                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $inmueble->titulo }}</h5>
                            <span class="badge {{ $inmueble->disponible ? 'bg-success' : 'bg-secondary' }}">
                                {{ $inmueble->disponible ? 'Disponible' : 'No disponible' }}
                            </span>

                            <p class="card-text mt-2">
                                <strong>Precio:</strong> €{{ number_format($inmueble->precio, 2) }}<br>
                                <strong>Zona:</strong> {{ $inmueble->zona }}<br>
                                <strong>Tipo operación:</strong> {{ ucfirst($inmueble->tipo_operacion) }}
                            </p>
                            <div class="d-flex flex-column gap-2 mt-3">
                                <a href="{{ route('inmuebles.showAdmin', $inmueble->id) }}" class="btn btn-outline-primary w-100">👁️ Ver</a>
                                <a href="{{ route('inmuebles.edit', $inmueble->id) }}" class="btn btn-outline-warning w-100">✏️ Editar</a>
                                <form action="{{ route('inmuebles.destroy', $inmueble->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este inmueble? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger w-100">🗑️ Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            <nav aria-label="Paginación de inmuebles">
                <ul class="pagination justify-content-center flex-wrap">
                    @php
                        $current = $inmuebles->currentPage();
                        $last = $inmuebles->lastPage();
                    @endphp

                    @if ($inmuebles->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $inmuebles->previousPageUrl() }}">Anterior</a></li>
                    @endif

                    @if ($current > 2)
                        <li class="page-item"><a class="page-link" href="{{ $inmuebles->url(1) }}">1</a></li>
                        @if ($current > 3)
                            <li class="page-item disabled"><span class="page-link">…</span></li>
                        @endif
                    @endif

                    @for ($i = max(1, $current - 1); $i <= min($last, $current + 1); $i++)
                        <li class="page-item {{ $current == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $inmuebles->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($current < $last - 1)
                        @if ($current < $last - 2)
                            <li class="page-item disabled"><span class="page-link">…</span></li>
                        @endif
                        <li class="page-item"><a class="page-link" href="{{ $inmuebles->url($last) }}">{{ $last }}</a></li>
                    @endif

                    @if ($inmuebles->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $inmuebles->nextPageUrl() }}">Siguiente</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Siguiente</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
