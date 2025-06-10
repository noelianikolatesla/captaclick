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
            <h2>Darse de alta como cliente</h2>
        </div>

        <form action="{{ route('cliente.alta') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="tipo_cliente" class="form-label">Tipo de Cliente</label>
                        <select id="tipo_cliente" name="tipo_cliente" class="form-select form-control-sm @error('tipo_cliente') is-invalid @enderror" required>
                            <option value="física" {{ old('tipo_cliente') == 'física' ? 'selected' : '' }}>Persona Física</option>
                            <option value="jurídica" {{ old('tipo_cliente') == 'jurídica' ? 'selected' : '' }}>Persona Jurídica</option>
                        </select>
                        @error('tipo_cliente')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control form-control-sm @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" maxlength="100">
                        @error('apellidos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" maxlength="100" required>
                        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="nif_cif" class="form-label">NIF / CIF</label>
                        <input type="text" class="form-control form-control-sm @error('nif_cif') is-invalid @enderror" id="nif_cif" name="nif_cif" value="{{ old('nif_cif') }}" maxlength="20" required>
                        @error('nif_cif')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control form-control-sm @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" maxlength="20" required>
                        @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
<div class="col-md-8">
    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email"
               class="form-control form-control-sm"
               id="email"
               name="email"
               value="{{ auth()->user()->email }}"
               readonly>
    </div>
</div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="codigo_postal" class="form-label">Código Postal</label>
                        <input type="text" class="form-control form-control-sm @error('codigo_postal') is-invalid @enderror" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal') }}" maxlength="10" required>
                        @error('codigo_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control form-control-sm @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion') }}" maxlength="150" required>
                        @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="localidad" class="form-label">Localidad</label>
                        <input type="text" class="form-control form-control-sm @error('localidad') is-invalid @enderror" id="localidad" name="localidad" value="{{ old('localidad') }}" maxlength="100" required>
                        @error('localidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="provincia" class="form-label">Provincia</label>
                        <input type="text" class="form-control form-control-sm @error('provincia') is-invalid @enderror" id="provincia" name="provincia" value="{{ old('provincia') }}" maxlength="100" required>
                        @error('provincia')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="pais" class="form-label">País</label>
                        <input type="text" class="form-control form-control-sm @error('pais') is-invalid @enderror" id="pais" name="pais" value="{{ old('pais', 'España') }}" maxlength="100" required>
                        @error('pais')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="iban" class="form-label">IBAN</label>
                        <input type="text" name="iban" id="iban" value="{{ old('iban') }}" class="form-control @error('iban') is-invalid @enderror">
                        @error('iban')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="tarifa_id" class="form-label">Tarifa</label>
                        <select id="tarifa_id" name="tarifa_id" class="form-select form-control-sm @error('tarifa_id') is-invalid @enderror" required>
                            <option value="">-- Selecciona una tarifa --</option>
                            @foreach($tarifas as $tarifa)
                                <option value="{{ $tarifa->id }}" {{ old('tarifa_id') == $tarifa->id ? 'selected' : '' }}>{{ $tarifa->nombre }} - {{ $tarifa->precio }} €</option>
                            @endforeach
                        </select>
                        @error('tarifa_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

<div class="form-check mb-3">
    <input class="form-check-input @error('condiciones') is-invalid @enderror" type="checkbox" name="condiciones" id="condiciones" {{ old('condiciones') ? 'checked' : '' }} required>
    <label class="form-check-label" for="condiciones">
        Acepto las <a href="{{ route('aviso.legal') }}" target="_blank" class="text-decoration-underline">condiciones del servicio</a>.
    </label>
    @error('condiciones')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>


            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success">Confirmar alta</button>
            </div>
        </form>
    </div>
</body>

</html>
