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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('nav')

    <div class="container mt-4">
        @include('app')

        <h2 class="mb-4">Listado de Visitas</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabla sin scroll -->
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle w-100">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th class="d-none d-sm-table-cell">Inmueble</th>
                        <th class="d-none d-md-table-cell">Cliente</th>
                        <th>Fecha</th>
                        <th class="d-none d-lg-table-cell">Hora</th>
                        <th>Estado</th>
                        <th class="d-none d-xl-table-cell">Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitas as $visita)
                    <tr>
                        <td>{{ $visita->id }}</td>
                        <td class="d-none d-sm-table-cell text-truncate" style="max-width: 150px;">{{ $visita->inmueble->titulo ?? 'N/A' }}</td>
                        <td class="d-none d-md-table-cell">{{ $visita->cliente->nombre ?? 'N/A' }}</td>
                        <td>{{ $visita->fechaVisita }}</td>
                        <td class="d-none d-lg-table-cell">{{ $visita->horaVisita }}</td>
                        <td>
                            @if($visita->estado == 'realizada')
                                <span class="badge bg-success">✔️ Realizada</span>
                            @else
                                <span class="badge bg-warning text-dark">⏳ Pendiente</span>
                            @endif
                        </td>
                        <td class="d-none d-xl-table-cell text-truncate" style="max-width: 200px;">{{ $visita->observaciones }}</td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @if($visita->acuerdo_generado)
                                    <a href="{{ route('visitas.verAcuerdo', $visita->id) }}" class="btn btn-outline-primary btn-sm">
                                        👁 <span class="d-none d-md-inline">Ver</span>
                                    </a>
                                @else
                                    <form action="{{ route('visitas.generarAcuerdo', $visita->id) }}" target="_blank" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">
                                            📝 <span class="d-none d-md-inline">Generar Acuerdo</span>
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('visitas.edit', $visita->id) }}" class="btn btn-outline-warning btn-sm">
                                    ✏️ <span class="d-none d-md-inline">Editar</span>
                                </a>

                                <form action="{{ route('visitas.destroy', $visita->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta visita?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        🗑️ <span class="d-none d-md-inline">Eliminar</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación con tres números y puntos suspensivos -->
        <div class="mt-4">
            <nav aria-label="Paginación de visitas">
                <ul class="pagination justify-content-center flex-wrap">
                    @php
                        $current = $visitas->currentPage();
                        $last = $visitas->lastPage();
                    @endphp

                    {{-- Anterior --}}
                    @if ($visitas->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $visitas->previousPageUrl() }}">Anterior</a></li>
                    @endif

                    {{-- Página 1 + puntos suspensivos --}}
                    @if ($current > 2)
                        <li class="page-item"><a class="page-link" href="{{ $visitas->url(1) }}">1</a></li>
                        @if ($current > 3)
                            <li class="page-item disabled"><span class="page-link">…</span></li>
                        @endif
                    @endif

                    {{-- Páginas actuales --}}
                    @for ($i = max(1, $current - 1); $i <= min($last, $current + 1); $i++)
                        <li class="page-item {{ $current == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $visitas->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Última página + puntos suspensivos --}}
                    @if ($current < $last - 1)
                        @if ($current < $last - 2)
                            <li class="page-item disabled"><span class="page-link">…</span></li>
                        @endif
                        <li class="page-item"><a class="page-link" href="{{ $visitas->url($last) }}">{{ $last }}</a></li>
                    @endif

                    {{-- Siguiente --}}
                    @if ($visitas->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $visitas->nextPageUrl() }}">Siguiente</a></li>
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
