<!DOCTYPE html>
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
    @include('app')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Nuevo Cliente</h2>
    </div>

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="tipo_cliente" class="form-label">Tipo de Cliente</label>
                    <select id="tipo_cliente" name="tipo_cliente" class="form-select form-control-sm @error('tipo_cliente') is-invalid @enderror" required>
                        <option value="física" {{ old('tipo_cliente') == 'física' ? 'selected' : '' }}>Persona Física</option>
                        <option value="jurídica" {{ old('tipo_cliente') == 'jurídica' ? 'selected' : '' }}>Persona Jurídica</option>
                    </select>
                    @error('tipo_cliente')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control form-control-sm @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" maxlength="100" value="{{ old('apellidos') }}">
                    @error('apellidos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror" id="nombre" name="nombre" maxlength="100" required value="{{ old('nombre') }}">
                    @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="nif_cif" class="form-label">NIF / CIF</label>
                    <input type="text" class="form-control form-control-sm @error('nif_cif') is-invalid @enderror" id="nif_cif" name="nif_cif" maxlength="9" required value="{{ old('nif_cif') }}">
                    @error('nif_cif')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control form-control-sm @error('telefono') is-invalid @enderror" id="telefono" name="telefono" maxlength="9" required value="{{ old('telefono') }}">
                    @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" maxlength="255" required value="{{ old('email') }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="codigo_postal" class="form-label">Código Postal</label>
                    <input type="text" class="form-control form-control-sm @error('codigo_postal') is-invalid @enderror" id="codigo_postal" name="codigo_postal" maxlength="5" required value="{{ old('codigo_postal') }}">
                    @error('codigo_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control form-control-sm @error('direccion') is-invalid @enderror" id="direccion" name="direccion" maxlength="150" required value="{{ old('direccion') }}">
                    @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="localidad" class="form-label">Localidad</label>
                    <input type="text" class="form-control form-control-sm @error('localidad') is-invalid @enderror" id="localidad" name="localidad" maxlength="100" required value="{{ old('localidad') }}">
                    @error('localidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="provincia" class="form-label">Provincia</label>
                    <input type="text" class="form-control form-control-sm @error('provincia') is-invalid @enderror" id="provincia" name="provincia" maxlength="100" required value="{{ old('provincia') }}">
                    @error('provincia')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="pais" class="form-label">País</label>
                    <input type="text" class="form-control form-control-sm @error('pais') is-invalid @enderror" id="pais" name="pais" maxlength="100" required value="{{ old('pais', 'España') }}">
                    @error('pais')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="iban" class="form-label">IBAN</label>
                    <input type="text" class="form-control form-control-sm @error('iban') is-invalid @enderror" id="iban" name="iban" maxlength="24" value="{{ old('iban') }}">
                    @error('iban')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea class="form-control form-control-sm @error('observaciones') is-invalid @enderror" id="observaciones" name="observaciones" rows="3" maxlength="500">{{ old('observaciones') }}</textarea>
                    @error('observaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-5">
            <a href="{{ route('admin.clientes') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success ml-2 mr-2">Guardar</button>
            <a href="{{ route('admin.inmuebles') }}" class="btn btn-secondary ml-2">Volver al listado</a>
        </div>
    </form>
</div>
</body>
</html>
