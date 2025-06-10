<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CaptaClik - Solicitar Visita</title>

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
        @include('app')

        <h2 class="text-center fw-bold mb-4">
            🏠 Solicitar visita para:<br>
            <span class="text-uppercase text-[#007c91]">{{ $inmueble->titulo }}</span>
            <hr class="mx-auto mt-2">
        </h2>

        <div class="card p-4 shadow-sm mx-auto" style="max-width: 900px;">
            <form method="POST" action="{{ route('visitas.guardar') }}">
                @csrf

                <input type="hidden" name="inmueble_id" value="{{ $inmueble->id }}">
                <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">

                <div class="mb-3">
                    <label for="fechaVisita" class="form-label fw-semibold">📅 Fecha de la visita:</label>
                    <input type="date" name="fechaVisita" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="horaVisita" class="form-label fw-semibold">⏰ Hora de la visita:</label>
                    <input type="time" name="horaVisita" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="observaciones" class="form-label fw-semibold">📝 Observaciones (opcional):</label>
                    <textarea name="observaciones" class="form-control" rows="3" placeholder="¿Algo que quieras añadir?"></textarea>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 pt-3">
                    <button type="submit" class="btn btn-success w-100 w-sm-auto">
                        ✨ Enviar Solicitud
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary w-100 w-sm-auto text-center">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
