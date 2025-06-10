
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CaptaClik</title>
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Estilos --> 

        @if (app()->environment('production')) 
        <!-- En producción, carga los estilos desde Firebase --> 
        <link rel="stylesheet" href="https://jet5-ec3cc.web.app/css/app.css"> 
        <script src="https://jet5-ec3cc.web.app/js/app.js"></script>
        @else 
        <!-- En desarrollo, usa los archivos generados por Vite --> 
        @vite(['public/css/app.css', 'public/js/app.js']) 
        @endif 

    </head>

    <body>

        @include('nav')


        <div class="container py-5">
            @include('app')
            <h2 class="mb-4">Crear Nuevo Inmueble</h2>

            <form action="{{ route('inmuebles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Titulo --}}
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                </div>
                {{-- Tipo operacion y tipo vivienda --}}
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="tipo_operacion" class="form-label">Tipo Operacion</label>
                        <select name="tipo_operacion" class="form-select rounded-xl shadow-sm focus:ring focus:ring-blue-200" required>
                            <option value="">Selecciona una opción</option>
                            <option value="alquiler">Alquiler</option>
                            <option value="compra">Compra</option>
                            <option value="traspaso">Traspaso</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_vivienda" class="form-label">Tipo Vivienda</label>
                        <select name="tipo_vivienda" class="form-select rounded-xl shadow-sm focus:ring focus:ring-blue-200" required>
                            <option value="">Selecciona una opción</option>
                            <option value="piso">Piso</option>
                            <option value="casa">Casa</option>
                            <option value="terreno">Terreno</option>
                            <option value="local">Local</option>
                            <option value="nave">Nave</option>
                        </select>
                    </div>
                </div>

                {{-- Calle y Número --}}
                <div class="row g-3">
                    <div class="col-md-8">
                        <label for="calle" class="form-label">Calle</label>
                        <input type="text" name="calle" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" name="numero" class="form-control" required>
                    </div>
                </div>

                {{-- Código Postal, Zona, Población, Provincia --}}
                <div class="row g-3 mt-3">
                    <div class="col-md-3">
                        <label for="codigo_postal" class="form-label">Código Postal</label>
                        <input type="text" name="codigo_postal" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="zona" class="form-label">Zona</label>
                        <input type="text" name="zona" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="poblacion" class="form-label">Población</label>
                        <input type="text" name="poblacion" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="provincia" class="form-label">Provincia</label>
                        <input type="text" name="provincia" class="form-control" required>
                    </div>
                </div>

                {{-- m2, Precio, Precio/m2, Habitaciones, Baños --}}
                <div class="row g-3 mt-3">
                    <div class="col-md-2">
                        <label for="m2" class="form-label">m²</label>
                        <input type="number" name="m2" id="m2" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" name="precio" id="precio" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="precio_m2" class="form-label">€/m²</label>
                        <input type="number" name="precio_m2" id="precio_m2" class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="habitaciones" class="form-label">Habitaciones</label>
                        <input type="number" name="habitaciones" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="banos" class="form-label">Baños</label>
                        <input type="number" name="banos" class="form-control" required>
                    </div>
                </div>

                {{-- Terraza, Garaje, Piscina, Estado --}}
                <div class="row g-3 mt-3 align-items-end">
                    <div class="col-md-3">
                        <input type="hidden" name="terraza" value="0"> <!-- Valor por defecto cuando no está marcado -->
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="terraza" id="terraza" value="1">
                            <label class="form-check-label" for="terraza">Terraza</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" name="garaje" value="0"> <!-- Valor por defecto cuando no está marcado -->
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="garaje" id="garaje" value="1">
                            <label class="form-check-label" for="garaje">Garaje</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" name="piscina" value="0"> <!-- Valor por defecto cuando no está marcado -->
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="piscina" id="piscina" value="1">
                            <label class="form-check-label" for="piscina">Piscina</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" class="form-select rounded-xl shadow-sm focus:ring focus:ring-blue-200" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Nuevo">Nuevo</option>
                            <option value="Reformado">Reformado</option>
                            <option value="para_reformar">Para reformar</option>
                        </select>
                    </div>
                </div>

                {{-- Propietario y Teléfono --}}
                <div class="row g-3 mt-3">
                    <div class="col-md-9">
                        <label for="propietario" class="form-label">Propietario</label>
                        <input type="text" name="propietario" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" required>
                    </div>
                </div>

                {{-- Observaciones y Descripción --}}
                <div class="row g-3 mt-3">
                    <div class="col-md-12">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea name="observaciones" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="4" required></textarea>
                    </div>
                </div>

                {{-- Imágenes --}}
                <div class="row g-3 mt-3">
                    <div class="col-md-12">
                        <label for="imagenes" class="form-label">Imágenes del inmueble</label>
                        <input type="file" name="imagenes[]" id="imagenes" class="form-control" accept="image/*" multiple>
                        @error('imagenes') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Botón --}}

                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('admin.clientes') }}" class="btn btn-secondary">Cancelar</a>

                    <button type="submit" class="btn btn-success ml-2 mr-2">Guardar</button>

                    <!-- Botón volver -->
                    <a href="{{ route('admin.inmuebles') }}" class="btn btn-secondary ml-2">Volver al listado</a>
                </div>


            </form>


        </div>

        <!-- Script para cálculo automático del precio por m² -->
        <script>
document.addEventListener('DOMContentLoaded', function () {
    const precio = document.getElementById('precio');
    const m2 = document.getElementById('m2');
    const precio_m2 = document.getElementById('precio_m2');

    function calcularPrecioM2() {
        const precioVal = parseFloat(precio.value);
        const m2Val = parseFloat(m2.value);
        if (!isNaN(precioVal) && !isNaN(m2Val) && m2Val > 0) {
            precio_m2.value = (precioVal / m2Val).toFixed(2);
        } else {
            precio_m2.value = '';
        }
    }

    precio.addEventListener('input', calcularPrecioM2);
    m2.addEventListener('input', calcularPrecioM2);
});
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
