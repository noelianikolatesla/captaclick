<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inmueble;
use App\Models\imagenPropiedad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class inmueblesController extends Controller {
    


// Para el ADMIN (usado en Blade/Livewire)
public function adminIndex(Request $request)
{
    // Obtener ciudades únicas (para el desplegable)
    $poblaciones = Inmueble::select('poblacion')->distinct()->orderBy('poblacion')->pluck('poblacion');

    // Construir la consulta base con imágenes
    $query = Inmueble::with('imagenPropiedad');

    // Aplicar filtros
    if ($request->filled('poblacion')) {
        $query->where('poblacion', $request->poblacion);
    }

    if ($request->filled('zona')) {
        $query->where('zona', 'like', '%' . $request->zona . '%');
    }

    if ($request->filled('precio_max')) {
        $query->where('precio', '<=', $request->precio_max);
    }

    if ($request->filled('tipo_operacion')) {
        $query->where('tipo_operacion', $request->tipo_operacion);
    }

    if ($request->boolean('disponible')) {
    $query->where('disponible', $request->boolean('disponible'));    }

    // Paginación (con filtros mantenidos)
    $inmuebles = $query->paginate(6)->withQueryString();

    // Pasar datos a la vista
    return view('admin.inmuebles', compact('inmuebles', 'poblaciones'));
}

    

    // mostrar el formulario de creación
    public function create() {
        // Aquí puedes pasar cualquier dato necesario a la vista
        return view('admin.nuevoInmueble');
    }

    // NUEVO INMUEBLE
    public function store(Request $request) {
        // Validación de las imágenes
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo_operacion' => 'required|string|max:255',
            'tipo_vivienda' => 'required|string|max:255',
            'calle' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'codigo_postal' => 'required|string|max:5',
            'poblacion' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'm2' => 'required|numeric',
            'habitaciones' => 'required|integer',
            'banos' => 'required|integer',
            'terraza' => 'required|boolean',
            'garaje' => 'required|boolean',
            'piscina' => 'required|boolean',
            'precio' => 'required|numeric',
            'precio_m2' => 'required|numeric',
            'estado' => 'required|string|max:255',
            'zona' => 'required|string|max:255',
            'propietario' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'observaciones' => 'nullable|string',
            'descripcion' => 'nullable|string',
            'imagenes' => 'required|array',
            'imagenes.*' => 'image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // Crear el inmueble
        $inmueble = Inmueble::create([
            'titulo' => $request->titulo,
            'tipo_operacion' => $request->tipo_operacion,
            'tipo_vivienda' => $request->tipo_vivienda,
            'calle' => $request->calle,
            'numero' => $request->numero,
            'codigo_postal' => $request->codigo_postal,
            'poblacion' => $request->poblacion,
            'provincia' => $request->provincia,
            'm2' => $request->m2,
            'habitaciones' => $request->habitaciones,
            'banos' => $request->banos,
            'terraza' => $request->terraza,
            'garaje' => $request->garaje,
            'piscina' => $request->piscina,
            'precio' => $request->precio,
            'precio_m2' => $request->precio_m2,
            'estado' => $request->estado,
            'zona' => $request->zona,
            'propietario' => $request->propietario,
            'telefono' => $request->telefono,
            'observaciones' => $request->observaciones,
            'descripcion' => $request->descripcion,
        ]);

        // Subir las imágenes y asociarlas al inmueble
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                // Guardar la imagen en storage/app/public/imagenes_propiedad
                $rutaImagen = $imagen->store('imagenes_propiedad', 'public');

                // Guardar la ruta de la imagen en la base de datos
                $inmueble->imagenPropiedad()->create([
                    'ruta_imagen' => $rutaImagen,
                ]);
            }
        }

        return redirect()->route('admin.inmuebles')->with('success', 'Inmueble creado con éxito');
    }

    // ACTUALIZAR INMUEBLE -- edit y update
    public function edit($id) {
        // Obtén el inmueble por su id
        $inmueble = Inmueble::with('imagenPropiedad')->findOrFail($id);  // Asegúrate de cargar la relación 'imagenes'
        // Retorna una vista con el inmueble a editar
        return view('admin.editarInmueble', compact('inmueble'));
    }

    public function update(Request $request, $id) {
        // Validación de datos del inmueble
        $request->validate([
            'titulo' => 'required|string|max:255',
            'tipo_operacion' => 'required|string|max:255',
            'tipo_vivienda' => 'required|string|max:255',
            'calle' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'codigo_postal' => 'required|string|max:5',
            'poblacion' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'm2' => 'required|numeric',
            'habitaciones' => 'required|integer',
            'banos' => 'required|integer',
            'terraza' => 'required|boolean',
            'garaje' => 'required|boolean',
            'piscina' => 'required|boolean',
            'precio' => 'required|numeric',
            'precio_m2' => 'required|numeric',
            'estado' => 'required|string|max:255',
            'zona' => 'required|string|max:255',
            'propietario' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'observaciones' => 'nullable|string',
            'descripcion' => 'nullable|string',
            'disponible' => 'required|boolean',
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Buscar el inmueble
            $inmueble = Inmueble::findOrFail($id);

            // Actualizar los campos del inmueble
            $inmueble->update([
                'titulo' => $request->titulo,
                'tipo_operacion' => $request->tipo_operacion,
                'tipo_vivienda' => $request->tipo_vivienda,
                'calle' => $request->calle,
                'numero' => $request->numero,
                'codigo_postal' => $request->codigo_postal,
                'poblacion' => $request->poblacion,
                'provincia' => $request->provincia,
                'm2' => $request->m2,
                'habitaciones' => $request->habitaciones,
                'banos' => $request->banos,
'terraza' => $request->boolean('terraza'),
'garaje' => $request->boolean('garaje'),
'piscina' => $request->boolean('piscina'),

                'precio' => $request->precio,
                'precio_m2' => $request->precio_m2,
                'estado' => $request->estado,
                'zona' => $request->zona,
                'propietario' => $request->propietario,
                'telefono' => $request->telefono,
                'observaciones' => $request->observaciones,
                'descripcion' => $request->descripcion,
'disponible' => $request->boolean('disponible'),
            ]);

            // Eliminar las imágenes seleccionadas
            if ($request->has('imagenes_a_eliminar')) {
                foreach ($request->imagenes_a_eliminar as $imagenId) {
                    $imagen = ImagenPropiedad::findOrFail($imagenId);

                    // Eliminar la imagen del almacenamiento
                    Storage::delete($imagen->ruta_imagen);

                    // Eliminar la imagen de la base de datos
                    $imagen->delete();
                }
            }

            // Subir nuevas imágenes
            // Subir las imágenes y asociarlas al inmueble
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $imagen) {
                    // Guardar la imagen en storage/app/public/imagenes_propiedad
                    $rutaImagen = $imagen->store('imagenes_propiedad', 'public');

                    // Guardar la ruta de la imagen en la base de datos
                    $inmueble->imagenPropiedad()->create([
                        'ruta_imagen' => $rutaImagen,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Hubo un error al actualizar el inmueble y las imágenes.');
        }

        return redirect()->route('admin.inmuebles')->with('success', 'Inmueble actualizado con éxito');
    }

    // ELIMINAR INMUEBLE
    public function destroy($id) {
        DB::beginTransaction(); // Inicia una transacción para asegurar la atomicidad

        try {
            // Buscar el inmueble
            $inmueble = Inmueble::findOrFail($id);

            // Eliminar las imágenes asociadas
            $imagenes = ImagenPropiedad::where('inmueble_id', $id)->get();
            foreach ($imagenes as $imagen) {
                // Eliminar el archivo de almacenamiento
                Storage::delete($imagen->ruta_imagen);
                // Eliminar la entrada en la base de datos
                $imagen->delete();
            }

            // Eliminar el inmueble
            $inmueble->delete();

            DB::commit(); // Confirma la transacción

            return redirect()->route('admin.inmuebles')->with('success', 'Inmueble eliminado con éxito');
        } catch (\Exception $e) {
            DB::rollBack(); // Deshace todos los cambios en caso de error
            return back()->with('error', 'Hubo un error al eliminar el inmueble y las imágenes.');
        }
    }

    //MOSTRAR DETALLES
    public function showAdmin($id) {
        $inmueble = Inmueble::findOrFail($id);
        return view('admin.detallesInmueble', compact('inmueble'));
    }
    
    
    /***************FUNCIONES USUARIO******************/
    
    public function userIndex(Request $request)
{
    // Obtener ciudades únicas
    $poblaciones = Inmueble::select('poblacion')->distinct()->orderBy('poblacion')->pluck('poblacion');

    // Consulta base con imágenes
    $query = Inmueble::with('imagenPropiedad');

    // Aplicar filtros
    if ($request->filled('poblacion')) {
        $query->where('poblacion', $request->poblacion);
    }

    if ($request->filled('zona')) {
        $query->where('zona', 'like', '%' . $request->zona . '%');
    }

    if ($request->filled('precio_max')) {
        $query->where('precio', '<=', $request->precio_max);
    }

    if ($request->filled('tipo_operacion')) {
        $query->where('tipo_operacion', $request->tipo_operacion);
    }

    if ($request->boolean('disponible')) {
        $query->where('disponible', true);
    }

    // Paginación
    $inmuebles = $query->paginate(9)->withQueryString();

    // Vista de usuario
    return view('user.inmuebles', compact('inmuebles', 'poblaciones'));
}

        public function showUser($id) {
        $inmueble = Inmueble::findOrFail($id);
        return view('user.detallesInmueble', compact('inmueble'));
    }

    
    
    
    
}
