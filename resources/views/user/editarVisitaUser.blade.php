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
</head>

<body>
    @include('nav')

    <div class="container mt-4">
        @include('appUser')

        <h2 class="mb-4">Editar Visita</h2>

        @php
            $esPendiente = $visita->estado === 'pendiente';
        @endphp

        <form action="{{ route('visitas.updateUser', $visita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="inmueble" class="form-label">Inmueble</label>
                    <select name="inmueble_id" class="form-select" required {{ !$esPendiente ? 'disabled' : '' }}>
                        @foreach($inmuebles as $inmueble)
                            <option value="{{ $inmueble->id }}" {{ $visita->inmueble_id == $inmueble->id ? 'selected' : '' }}>
                                {{ $inmueble->titulo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="cliente" class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select" required {{ !$esPendiente ? 'disabled' : '' }}>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $visita->cliente_id == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }} {{ $cliente->apellidos }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="fechaVisita" class="form-label">Fecha de Visita</label>
                    <input type="date" name="fechaVisita" class="form-control" value="{{ old('fechaVisita', $visita->fechaVisita) }}" required {{ !$esPendiente ? 'disabled' : '' }}>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="horaVisita" class="form-label">Hora de Visita</label>
                    <input type="time" name="horaVisita" class="form-control" value="{{ old('horaVisita', $visita->horaVisita) }}" required {{ !$esPendiente ? 'disabled' : '' }}>
                </div>

<div class="col-md-4">
    <label for="estado" class="form-label">Estado</label>
    <input type="text" class="form-control" value="{{ ucfirst($visita->estado) }}" disabled>
    <input type="hidden" name="estado" value="{{ $visita->estado }}">
</div>



                <div class="col-md-4">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="3" {{ !$esPendiente ? 'disabled' : '' }}>{{ old('observaciones', $visita->observaciones) }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="acuerdo_generado" class="form-label">Acuerdo Generado</label>
                    <select name="acuerdo_generado" class="form-select" required {{ !$esPendiente ? 'disabled' : '' }}>
                        <option value="1" {{ $visita->acuerdo_generado == 1 ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ $visita->acuerdo_generado == 0 ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="acuerdo_pdf" class="form-label">Acuerdo PDF</label>
                    <input type="file" name="acuerdo_pdf" class="form-control" {{ !$esPendiente ? 'disabled' : '' }}>
                    <small class="text-muted">Dejar en blanco si no hay archivo PDF nuevo</small>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                @if($esPendiente)
                    <button type="submit" class="btn btn-visita">
                        🔄 Actualizar Visita
                    </button>
                @endif

                <a href="{{ route('user.visitas') }}" class="btn btn-volver">
                    Volver al listado
                </a>
            </div>
        </form>
    </div>
</body>

</html>
