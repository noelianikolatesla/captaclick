<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\InmueblesController;
use App\Http\Controllers\clientesController;
use App\Http\Controllers\visitasController;
use Illuminate\Support\Facades\DB;

Route::get('/ver-cola', function () {
    return DB::table('jobs')->get();
});

//Route::get('/home', function () {
//    return view('dashboard'); // o la vista que prefieras
//})->middleware(['auth', 'verified'])->name('home');
// Redirección personalizada de usuarios autenticados
//Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
//        ->get('/redirect', function () {
//            $user = auth()->user();
//
//            if ($user && method_exists($user, 'hasRole')) {
//                return redirect($user->hasRole('admin') ? '/dashboard' : '/home');
//            }
//
//            return redirect('/login');
//        })->name('redirect');
// Página de bienvenida (pública)
Route::get('/', function () {
    return view('welcome');
});


// Ruta que redirige segun el rol
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->rol === 'admin') {
        return redirect()->route('admin.inmuebles');
    } elseif ($user->rol === 'user') {
        return redirect()->route('user.inmuebles');
    }

    return redirect('/'); // fallback por si acaso no se logea bien
})->middleware(['auth', 'verified'])->name('dashboard');


// Grupo de rutas para ADMIN (Blade o Livewire)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
        ->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
//*********INMUEBLES*************//
            Route::get('/admin/inmuebles', [inmueblesController::class, 'adminIndex'])
                    ->name('admin.inmuebles')
                    ->middleware('role:admin'); // Middleware de rol movido aquí
            // Agrega esta línea para la creación de un nuevo inmueble
            Route::get('/admin/nuevoInmueble', [InmueblesController::class, 'create'])
                    ->name('inmuebles.create')
                    ->middleware('role:admin'); // Solo accesible para admin
            //
            // Ruta para almacenar el nuevo inmueble (ruta store)
            Route::post('/admin/inmuebles', [InmueblesController::class, 'store'])
                    ->name('inmuebles.store')
                    ->middleware('role:admin'); // Solo accesible para admin
            //
            //ruta para mostrar formulario de edicion
            Route::get('/admin/editarInmueble/{inmueble}/editar', [InmueblesController::class, 'edit'])
                    ->name('inmuebles.edit')
                    ->middleware('role:admin');
            //procesar actulizacion PUT o PATCH
            Route::put('/admin/editarInmueble/{inmueble}', [InmueblesController::class, 'update'])
                    ->name('inmuebles.update')
                    ->middleware('role:admin');

            //ruta para eliminar
            Route::delete('/admin/eliminarInmueble/{inmueble}', [InmueblesController::class, 'destroy'])
                    ->name('inmuebles.destroy')
                    ->middleware('role:admin');

            //ruta para mostrar
            Route::get('/admin/detallesInmueble/{inmueble}/mostrar', [InmueblesController::class, 'showAdmin'])
                    ->name('inmuebles.showAdmin')
                    ->middleware('role:admin');

//**********CLIENTES*****************//
            Route::get('/admin/clientes', [App\Http\Controllers\clientesController::class, 'listaClientes'])
                    ->name('admin.clientes')
                    ->middleware('role:admin');

            //crear nuevo
            Route::get('/admin/nuevoCliente', [App\Http\Controllers\clientesController::class, 'create'])
                    ->name('clientes.create')
                    ->middleware('role:admin');
            //guardar nuevo
            Route::post('/admin/clientes', [App\Http\Controllers\clientesController::class, 'store'])
                    ->name('clientes.store')
                    ->middleware('role:admin'); // Solo accesible para admin
            //ver detalles
            Route::get('/admin/detallesCliente/{cliente}/mostrar', [clientesController::class, 'showAdmin'])
                    ->name('clientes.showAdmin')
                    ->middleware('role:admin');

            //ruta para mostrar formulario de edicion
            Route::get('/admin/editarCliente/{cliente}/editar', [clientesController::class, 'edit'])
                    ->name('clientes.edit')
                    ->middleware('role:admin');
            //procesar actulizacion PUT o PATCH
            Route::put('/admin/editarCliente/{cliente}', [clientesController::class, 'update'])
                    ->name('clientes.update')
                    ->middleware('role:admin');

            //ruta para eliminar
            Route::delete('/admin/eliminarCliente/{cliente}', [clientesController::class, 'destroy'])
                    ->name('clientes.destroy')
                    ->middleware('role:admin');

//**********VISITAS*****************//
            /* LISTADO */
            Route::get('/admin/visitas', [App\Http\Controllers\visitasController::class, 'show'])
                    ->name('admin.visitas')
                    ->middleware('role:admin');

            //crear nuevo
            Route::get('/admin/seleccionar-cliente/{idInmueble}', [App\Http\Controllers\visitasController::class, 'seleccionarCliente'])
                    ->name('visitas.seleccionarCliente')
                    ->middleware('role:admin');

            Route::get('/admin/programar-visita', [App\Http\Controllers\visitasController::class, 'crearDesdeCliente'])
                    ->name('visitas.nuevaVisita')
                    ->middleware('role:admin');

            Route::post('/admin/confirmar', [App\Http\Controllers\visitasController::class, 'confirmar'])
                    ->name('visitas.confirmarVisita')
                    ->middleware('role:admin');

            Route::post('/admin/visitas/store', [App\Http\Controllers\visitasController::class, 'store'])
                    ->name('visitas.store')
                    ->middleware('role:admin');

            //ruta realizar acuerdo
            Route::post('/admin/acuerdo/{id}', [visitasController::class, 'generarAcuerdo'])
                    ->name('visitas.generarAcuerdo')
                    ->middleware('role:admin');

            //ruta mostrar acuerdo
            Route::get('/admin/acuerdo/{id}', [visitasController::class, 'verAcuerdo'])
                    ->name('visitas.verAcuerdo')
                    ->middleware('role:admin');

            //ruta para mostrar formulario de edicion
            Route::get('/admin/editarVisita/{visita}/editar', [visitasController::class, 'edit'])
                    ->name('visitas.edit')
                    ->middleware('role:admin');
            //procesar actulizacion PUT o PATCH
            Route::put('/admin/editarVisita/{visita}', [visitasController::class, 'update'])
                    ->name('visitas.update')
                    ->middleware('role:admin');

            //ruta para eliminar
            Route::delete('/admin/eliminarVisita/{visita}', [visitasController::class, 'destroy'])
                    ->name('visitas.destroy')
                    ->middleware('role:admin');
        });



/****************************************************************************/
//Rutas USER
//ruta tras el registro:

Route::get('/inicio', [clientesController::class, 'inicio'])
        ->middleware(['auth', 'verified', 'role:user']) // incluye tus middlewares si los usas
        ->name('inicio');

Route::get('/home', [clientesController::class, 'showAltaForm'])
        ->middleware(['auth', 'verified', 'role:user'])
        ->name('home');

Route::post('/alta', [clientesController::class, 'alta'])
        ->middleware(['auth', 'verified', 'role:user'])
        ->name('cliente.alta');
///////
Route::get('/condiciones', function () {
    return view('condiciones');
})->name('aviso.legal');


//ruta a inmuebles despues del login:
Route::get('/inmuebles', [inmueblesController::class, 'userIndex'])
        ->middleware(['auth', 'verified', 'role:user'])
        ->name('user.inmuebles');

//ruta para mostrar detalles inmuebles
Route::get('/user/detallesInmueble/{inmueble}/mostrar', [inmueblesController::class, 'showUser'])
        ->name('inmuebles.showUser')
        ->middleware(['auth', 'verified', 'role:user']);

           //ver detalles clientes
            Route::get('/user/detallesCliente/{cliente}/mostrar', [clientesController::class, 'showUser'])
                    ->name('clientes.showUser')
                    ->middleware(['auth', 'verified', 'role:user']);

Route::get('/user/visitas/{inmueble}/formulario', [visitasController::class, 'formularioSolicitud'])
        ->name('visitas.formulario')
        ->middleware(['auth', 'verified', 'role:user']);

Route::post('/user/visitas/guardar', [visitasController::class, 'guardarSolicitud'])
        ->name('visitas.guardar')
        ->middleware(['auth', 'verified', 'role:user']);

//mi perfil
Route::get('/user/clientes', [App\Http\Controllers\clientesController::class, 'listaClientesUser'])
        ->name('user.clientes')
        ->middleware('role:user');

/* LISTADO */
Route::get('/user/visitas', [App\Http\Controllers\visitasController::class, 'showUser'])
        ->name('user.visitas')
        ->middleware('role:user');

Route::post('/inmueble/{inmueble}/favorito', [\App\Http\Controllers\FavoritosController::class, 'toggle'])
        ->name('inmueble.favorito')
        ->middleware(['auth', 'verified', 'role:user']);

Route::get('/user/favoritos', [clientesController::class, 'verFavoritos'])
        ->name('user.favoritos')
        ->middleware(['auth', 'verified', 'role:user']);

            //ruta realizar acuerdo
            Route::post('/user/acuerdo/{id}', [visitasController::class, 'generarAcuerdoUser'])
                    ->name('visitas.generarAcuerdoUser')
                    ->middleware('role:user');

            //ruta mostrar acuerdo
            Route::get('/user/acuerdo/{id}', [visitasController::class, 'verAcuerdoUser'])
                    ->name('visitas.verAcuerdoUser')
                    ->middleware('role:user');
            
                        //ruta para mostrar formulario de edicion USUARIO
            Route::get('/user/editarCliente/{cliente}/editar', [clientesController::class, 'editUser'])
                    ->name('clientes.editUser')
                    ->middleware('role:user');
            //procesar actulizacion PUT o PATCH
            Route::put('/user/editarCliente/{cliente}', [clientesController::class, 'updateUser'])
                    ->name('clientes.updateUser')
                    ->middleware('role:user');
            
                        //ruta para mostrar formulario de edicion
            Route::get('/user/editarVisita/{visita}/editar', [visitasController::class, 'editUser'])
                    ->name('visitas.editUser')
                    ->middleware('role:user');
            //procesar actulizacion PUT o PATCH
            Route::put('/user/editarVisita/{visita}', [visitasController::class, 'updateUser'])
                    ->name('visitas.updateUser')
                    ->middleware('role:user');


/* * ********************************************************************** */

