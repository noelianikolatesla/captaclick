<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CaptaClik</title>

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

        @include('nav')

        <div class="container mt-4">
            @include('appUser')
    <h2 class="mb-4">Editar Cliente</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Corrige los siguientes errores:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.updateUser', $cliente->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="tipo_cliente" class="form-label">Tipo de Cliente</label>
                <select name="tipo_cliente" class="form-select @error('tipo_cliente') is-invalid @enderror" required>
                    <option value="física" {{ $cliente->tipo_cliente == 'física' ? 'selected' : '' }}>Particular</option>
                    <option value="jurídica" {{ $cliente->tipo_cliente == 'jurídica' ? 'selected' : '' }}>Empresa</option>
                </select>
                @error('tipo_cliente')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $cliente->nombre) }}" required>
                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos', $cliente->apellidos) }}">
                @error('apellidos')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="nif_cif" class="form-label">NIF / CIF</label>
                <input type="text" name="nif_cif" class="form-control @error('nif_cif') is-invalid @enderror" value="{{ old('nif_cif', $cliente->nif_cif) }}">
                @error('nif_cif')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $cliente->telefono) }}">
                @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $cliente->email) }}" readonly>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text text-danger mt-1">
                    Para modificar el email, contacta con <a href="mailto:noelia.alafarga@captaclick.com">noelia.alafarga@captaclick.com</a> o llama al <a href="tel:961702124">961 702 124</a>.
                </div>
            </div>
            <div class="col-md-3">
                <label for="iban" class="form-label">IBAN</label>
                <input type="text" name="iban" class="form-control @error('iban') is-invalid @enderror" value="{{ old('iban', $cliente->iban) }}">
                @error('iban')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion', $cliente->direccion) }}">
                @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label for="codigo_postal" class="form-label">Código Postal</label>
                <input type="text" name="codigo_postal" class="form-control @error('codigo_postal') is-invalid @enderror" value="{{ old('codigo_postal', $cliente->codigo_postal) }}">
                @error('codigo_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="localidad" class="form-label">Localidad</label>
                <input type="text" name="localidad" class="form-control @error('localidad') is-invalid @enderror" value="{{ old('localidad', $cliente->localidad) }}">
                @error('localidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label for="provincia" class="form-label">Provincia</label>
                <input type="text" name="provincia" class="form-control @error('provincia') is-invalid @enderror" value="{{ old('provincia', $cliente->provincia) }}">
                @error('provincia')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="pais" class="form-label">País</label>
                <input type="text" name="pais" class="form-control @error('pais') is-invalid @enderror" value="{{ old('pais', $cliente->pais) }}">
                @error('pais')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                <input type="date" name="fecha_alta" class="form-control @error('fecha_alta') is-invalid @enderror" value="{{ old('fecha_alta', $cliente->fecha_alta) }}">
                @error('fecha_alta')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-control @error('observaciones') is-invalid @enderror">{{ old('observaciones', $cliente->observaciones) }}</textarea>
                @error('observaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center gap-3">
            <button type="submit" class="btn btn-visita">
                🔄 Actualizar
            </button>

            <a href="{{ route('user.clientes') }}" class="btn btn-volver">
                Volver al listado
            </a>
        </div>
    </form>
</div>

</body>
</html>
