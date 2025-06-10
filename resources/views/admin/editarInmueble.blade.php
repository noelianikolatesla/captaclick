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
            @include('app')
            <h2>Editar Inmueble</h2>

            <form action="{{ route('inmuebles.update', $inmueble->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $inmueble->titulo) }}" required>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="tipo_operacion" class="form-label">Tipo Operacion</label>
                        <select name="tipo_operacion" class="form-select rounded-xl shadow-sm focus:ring focus:ring-blue-200" required>
                            <option value="">Selecciona una opción</option>
                            <option value="alquiler" {{ old('tipo_operacion', $inmueble->tipo_operacion) == 'alquiler' ? 'selected' : '' }}>Alquiler</option>
                            <option value="compra" {{ old('tipo_operacion', $inmueble->tipo_operacion) == 'compra' ? 'selected' : '' }}>Compra</option>
                            <option value="traspaso" {{ old('tipo_operacion', $inmueble->tipo_operacion) == 'traspaso' ? 'selected' : '' }}>Traspaso</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_vivienda" class="form-label">Tipo Vivienda</label>
                        <select name="tipo_vivienda" class="form-select rounded-xl shadow-sm focus:ring focus:ring-blue-200" required>
                            <option value="">Selecciona una opción</option>
                            <option value="piso" {{ old('tipo_vivienda', $inmueble->tipo_vivienda) == 'piso' ? 'selected' : '' }}>Piso</option>
                            <option value="casa" {{ old('tipo_vivienda', $inmueble->tipo_vivienda) == 'casa' ? 'selected' : '' }}>Casa</option>
                            <option value="terreno" {{ old('tipo_vivienda', $inmueble->tipo_vivienda) == 'terreno' ? 'selected' : '' }}>Terreno</option>
                            <option value="local" {{ old('tipo_vivienda', $inmueble->tipo_vivienda) == 'local' ? 'selected' : '' }}>Local</option>
                            <option value="nave" {{ old('tipo_vivienda', $inmueble->tipo_vivienda) == 'nave' ? 'selected' : '' }}>Nave</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="calle">Calle</label>
                        <input type="text" name="calle" class="form-control" value="{{ $inmueble->calle }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="numero">Número</label>
                        <input type="text" name="numero" class="form-control" value="{{ $inmueble->numero }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="codigo_postal">Código Postal</label>
                        <input type="text" name="codigo_postal" class="form-control" value="{{ $inmueble->codigo_postal }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="poblacion">Población</label>
                        <input type="text" name="poblacion" class="form-control" value="{{ $inmueble->poblacion }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="provincia">Provincia</label>
                        <input type="text" name="provincia" class="form-control" value="{{ $inmueble->provincia }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="zona">Zona</label>
                        <input type="text" name="zona" class="form-control" value="{{ $inmueble->zona }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="m2">Metros</label>
                        <input type="number" name="m2" id="m2" class="form-control" value="{{ $inmueble->m2 }}" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="precio">Precio</label>
                        <input type="number" name="precio" id="precio" class="form-control" value="{{ $inmueble->precio }}" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="precio_m2">Precio metro </label>
                        <input type="number" name="precio_m2" id="precio_m2" class="form-control" value="{{ $inmueble->precio_m2 }}" required readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="habitaciones">Habitaciones</label>
                        <input type="number" name="habitaciones" class="form-control" value="{{ $inmueble->habitaciones }}" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="banos">Baños</label>
                        <input type="number" name="banos" class="form-control" value="{{ $inmueble->banos }}" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control">
                            <option value="Nuevo" {{ $inmueble->estado === 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
                            <option value="Reformado" {{ $inmueble->estado === 'Reformado' ? 'selected' : '' }}>Reformado</option>
                            <option value="para_reformar" {{ $inmueble->estado === 'Para reformar' ? 'selected' : '' }}>Para reformar</option>
                        </select>
                    </div>
                </div>

                <script>
        document.addEventListener('input', () => {
            const m2 = parseFloat(document.getElementById('m2').value);
            const precio = parseFloat(document.getElementById('precio').value);
            const precioM2 = document.getElementById('precio_m2');
            if (!isNaN(m2) && m2 > 0 && !isNaN(precio)) {
                precioM2.value = (precio / m2).toFixed(2);
            }
        });
                </script>

                <div class="row m-4">
                    <div class="form-group col-md-3 form-check">
                        <input type="hidden" name="terraza" value="0">
                        <input type="checkbox" class="form-check-input" name="terraza" id="terraza" value="1" {{ $inmueble->terraza == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="terraza">Terraza</label>
                    </div>
                    <div class="form-group col-md-3 form-check">
                        <input type="hidden" name="garaje" value="0">
                        <input type="checkbox" class="form-check-input" name="garaje" id="garaje" value="1" {{ $inmueble->garaje == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="garaje">Garaje</label>
                    </div>
                    <div class="form-group col-md-3 form-check">
                        <input type="hidden" name="piscina" value="0">
                        <input type="checkbox" class="form-check-input" name="piscina" id="piscina" value="1" {{ $inmueble->piscina == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="piscina">Piscina</label>
                    </div>
                    <div class="form-group col-md-3 form-check">
                        <input type="hidden" name="disponible" value="0">
                        <input type="checkbox" class="form-check-input" name="disponible" id="disponible" value="1" {{ $inmueble->disponible == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="piscina">Disponible</label>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-9">
                        <label for="propietario">Propietario</label>
                        <input type="text" name="propietario" class="form-control" value="{{ $inmueble->propietario }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telefono">Teléfono</label>
                        <input type="number" name="telefono" class="form-control" value="{{ $inmueble->telefono }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea name="observaciones" class="form-control" required>{{ $inmueble->observaciones }}</textarea>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" required>{{ $inmueble->descripcion }}</textarea>
                </div>

                <div class="form-group">
                    <label for="imagenes">Imágenes actuales:</label>
                    @if($inmueble->imagenPropiedad->isNotEmpty())
                    <div class="d-flex flex-wrap gap-3 mt-2">
                        @foreach($inmueble->imagenPropiedad as $imagen)
                        <div class="text-center" style="width: 120px;">
                            <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" alt="Imagen actual" style="width: 100px; height: 100px; object-fit: cover;" class="rounded shadow-sm mb-1">
                            <input type="checkbox" name="imagenes_a_eliminar[]" value="{{ $imagen->id }}">
                            <label style="display: block; font-size: 14px; margin-top: 4px;">Eliminar</label>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p>No hay imágenes disponibles.</p>
                    @endif
                </div>

                <div class="form-group mt-3">
                    <label for="imagenes">Imágenes nuevas (opcional):</label>
                    <input type="file" name="imagenes[]" class="form-control" accept="image/*" multiple>
                    @error('imagenes')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4 d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-visita">💾 Guardar</button>
                    <a href="{{ route('admin.inmuebles') }}" class="btn btn-volver">Volver al listado</a>
                </div>
            </form>
        </div>

    </body>
</html>
