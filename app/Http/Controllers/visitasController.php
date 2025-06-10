<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\visita;  // Asegúrate de importar el modelo Cliente
use App\Models\inmueble;
use App\Models\cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Notifications\VisitaConfirmada;
use App\Notifications\VisitaSolicitada;

use App\Jobs\SendEmail;
use App\Mail\SolicitudVisitaMail;

class visitasController extends Controller {
    

/********* USUARIO ****************/


public function formularioSolicitud(Inmueble $inmueble)
{
    $cliente = Cliente::where('email', auth()->user()->email)->firstOrFail();
    return view('emails.visita.solicitud', compact('inmueble', 'cliente'));
}


public function guardarSolicitud(Request $request)
{
    $request->validate([
        'inmueble_id' => 'required|exists:inmuebles,id',
        'cliente_id' => 'required|exists:clientes,id',
        'fechaVisita' => 'required|date',
        'horaVisita' => 'required',
        'observaciones' => 'nullable|string',
    ]);

    $visita = new Visita();
    $visita->inmueble_id = $request->inmueble_id;
    $visita->cliente_id = $request->cliente_id;
    $visita->fechaVisita = $request->fechaVisita;
    $visita->horaVisita = $request->horaVisita;
    $visita->observaciones = $request->observaciones;
    $visita->estado = 'pendiente';
    $visita->save();

$visita->load('inmueble', 'cliente');

// Obtener el cliente
$cliente = Cliente::findOrFail($request->cliente_id);

// Registrar en el log
\Log::info('Solicitud enviada por el cliente ' . $cliente->email);

// Enviar notificación por correo al cliente (u otra persona si lo necesitas)
$cliente->notify(new \App\Notifications\VisitaSolicitada($visita));




return redirect()->route('user.inmuebles')
    ->with('success', 'Solicitud enviada correctamente, en breve contactaremos confirmando.');

}

public function showUser()
{
    // Obtener el email del usuario autenticado
    $email = Auth::user()->email;

    // Filtrar las visitas donde el email del cliente coincida
    $visitas = Visita::with(['cliente', 'inmueble'])
                ->whereHas('cliente', function ($query) use ($email) {
                    $query->where('email', $email);
                })
                ->paginate(4);

    // Devolver la vista de usuario
    return view('user.visitas', compact('visitas'));
}

 public function verAcuerdoUser($id) {
        $visita = Visita::findOrFail($id);
        $tipo = strtolower($visita->inmueble->tipo_operacion);
        $filePath = public_path("pdf/acuerdo_{$tipo}_visita_{$visita->id}.pdf");

        if (file_exists($filePath)) {
            return response()->file($filePath); // Lo muestra en el navegador
        } else {
            return redirect()->back()->with('error', 'El acuerdo aún no ha sido generado.');
        }
    }

    public function generarAcuerdoUser($id) {
        $visita = Visita::with(['inmueble', 'cliente'])->findOrFail($id);

        // Actualizar el estado
        $visita->estado = 'realizada';
        $visita->acuerdo_generado = '1';
        $visita->save();

        // Obtener el tipo de operación del inmueble (venta, alquiler, traspaso)
        $tipo = strtolower($visita->inmueble->tipo_operacion); // Asegúrate que el campo "tipo" existe en inmuebles
        // Generar el PDF según el tipo -- PONER LA RUTA DE LA CARPETA
        $pdf = Pdf::loadView("admin.acuerdo_$tipo", compact('visita'));

        // Guardar el PDF en el directorio public/pdf
        $filePath = "pdf/acuerdo_{$tipo}_visita_{$visita->id}.pdf";
        $pdf->save(public_path($filePath));
        return $pdf->stream("acuerdo_{$tipo}_visita_{$visita->id}.pdf");

//        return $pdf->download("acuerdo_{$tipo}_visita_{$visita->id}.pdf");
    }
    public function editUser($id) {
    // Obtén la visita por su id
    $visita = Visita::with('inmueble', 'cliente')->findOrFail($id);  // Asegúrate de cargar las relaciones necesarias

    // Obtener todos los inmuebles disponibles para el select
    $inmuebles = Inmueble::all();

    // Obtener todos los clientes disponibles para el select
    $clientes = Cliente::all();

    // Retorna la vista con la visita, inmuebles y clientes
    return view('user.editarVisitaUser', compact('visita', 'inmuebles', 'clientes'));
}

public function updateUser(Request $request, $id) {
    // Validación de los campos
//    $request->validate([
//        'inmueble_id' => 'required|exists:inmuebles,id', // Verifica que el inmueble exista
//        'cliente_id' => 'required|exists:clientes,id', // Verifica que el cliente exista
//        'fechaVisita' => 'required|date',
//        'horaVisita' => 'required|date_format:H:i',
//        'estado' => 'required|in:pendiente,confirmada,realizada,cancelada',
//        'observaciones' => 'nullable|string',
//        'acuerdo_pdf' => 'nullable|mimes:pdf|max:2048', // Validación del archivo PDF
//    ]);

    // Buscar el registro de la visita
    $visita = Visita::findOrFail($id);

    // Actualizar los campos manualmente
    $visita->inmueble_id = $request->inmueble_id;
    $visita->cliente_id = $request->cliente_id;
    $visita->fechaVisita = $request->fechaVisita;
    $visita->horaVisita = $request->horaVisita;
    $visita->estado = $request->estado;
    $visita->observaciones = $request->observaciones;

    // Si se sube un archivo
    if ($request->hasFile('acuerdo_pdf')) {
        $file = $request->file('acuerdo_pdf');
        $path = $file->store('acuerdos', 'public'); // Guarda el archivo en la carpeta 'acuerdos' dentro del directorio 'public'
        $visita->acuerdo_pdf = $path;
    }

    // Guardar la visita actualizada
    $visita->save();

    // Redirigir al listado de visitas
    return redirect()->route('user.visitas')->with('success', 'Visita actualizada correctamente');
}



    
    
/************ADMIN**************************/
public function show() {
    $visitas = Visita::with(['cliente', 'inmueble'])->paginate(4);
    return view('admin.visitas', compact('visitas'));
}


    public function seleccionarCliente($idInmueble) {
        $clientes = Cliente::all();
        return view('admin.seleccionar-cliente', compact('clientes', 'idInmueble'));
    }

    public function crearDesdeCliente(Request $request) {
        $idInmueble = $request->input('idInmueble');
        $idCliente = $request->input('idCliente');

        $inmueble = Inmueble::findOrFail($idInmueble);
        $cliente = Cliente::findOrFail($idCliente);

        return view('admin.nuevaVisita', compact('inmueble', 'cliente'));
    }

    public function confirmar(Request $request) {
        $inmueble = Inmueble::findOrFail($request->idInmueble);
        $cliente = Cliente::findOrFail($request->idCliente);

        $datos = $request->only(['idInmueble', 'idCliente', 'fechaVisita', 'horaVisita', 'observaciones']);

        return view('admin.confirmarVisita', compact('inmueble', 'cliente', 'datos'));
    }

    public function storeBorrar(Request $request) {
        $request->validate([
            'idInmueble' => 'required|exists:inmuebles,id',
            'idCliente' => 'required|exists:clientes,id',
            'fechaVisita' => 'required|date',
            'horaVisita' => 'required',
            'observaciones' => 'nullable|string',
        ]);

        Visita::create([
            'inmueble_id' => $request->idInmueble,
            'cliente_id' => $request->idCliente,
            'fechaVisita' => $request->fechaVisita,
            'horaVisita' => $request->horaVisita,
            'estado' => 'pendiente',
            'observaciones' => $request->observaciones,
        ]);

        return redirect()->route('admin.visitas')->with('success', 'Visita programada correctamente.');
    }

    public function verAcuerdo($id) {
        $visita = Visita::findOrFail($id);
        $tipo = strtolower($visita->inmueble->tipo_operacion);
        $filePath = public_path("pdf/acuerdo_{$tipo}_visita_{$visita->id}.pdf");

        if (file_exists($filePath)) {
            return response()->file($filePath); // Lo muestra en el navegador
        } else {
            return redirect()->back()->with('error', 'El acuerdo aún no ha sido generado.');
        }
    }

    public function generarAcuerdo($id) {
        $visita = Visita::with(['inmueble', 'cliente'])->findOrFail($id);

        // Actualizar el estado
        $visita->estado = 'realizada';
        $visita->acuerdo_generado = '1';
        $visita->save();

        // Obtener el tipo de operación del inmueble (venta, alquiler, traspaso)
        $tipo = strtolower($visita->inmueble->tipo_operacion); // Asegúrate que el campo "tipo" existe en inmuebles
        // Generar el PDF según el tipo -- PONER LA RUTA DE LA CARPETA
        $pdf = Pdf::loadView("admin.acuerdo_$tipo", compact('visita'));

        // Guardar el PDF en el directorio public/pdf
        $filePath = "pdf/acuerdo_{$tipo}_visita_{$visita->id}.pdf";
        $pdf->save(public_path($filePath));
        return $pdf->stream("acuerdo_{$tipo}_visita_{$visita->id}.pdf");

//        return $pdf->download("acuerdo_{$tipo}_visita_{$visita->id}.pdf");
    }

    public function store(Request $request) {
        $request->validate([
            'idInmueble' => 'required|exists:inmuebles,id',
            'idCliente' => 'required|exists:clientes,id',
            'fechaVisita' => 'required|date',
            'horaVisita' => 'required',
            'observaciones' => 'nullable|string',
        ]);

        $visita = new Visita();
        $visita->cliente_id = $request->idCliente; // corregido
        $visita->inmueble_id = $request->idInmueble; // corregido
        $visita->fechaVisita = $request->fechaVisita;
        $visita->horaVisita = $request->horaVisita;
        $visita->observaciones = $request->observaciones;
        $visita->estado = 'pendiente';
        $visita->save();

        $visita->load('inmueble', 'cliente');
        $cliente = Cliente::findOrFail($request->idCliente);

        Log::info('Enviando notificación a ' . $cliente->email);

        // Enviar notificación sin cola
        $cliente->notify(new VisitaConfirmada($visita));

        return redirect()->route('admin.visitas')->with('success', 'Visita confirmada y correo enviado.');
    }

public function edit($id) {
    // Obtén la visita por su id
    $visita = Visita::with('inmueble', 'cliente')->findOrFail($id);  // Asegúrate de cargar las relaciones necesarias

    // Obtener todos los inmuebles disponibles para el select
    $inmuebles = Inmueble::all();

    // Obtener todos los clientes disponibles para el select
    $clientes = Cliente::all();

    // Retorna la vista con la visita, inmuebles y clientes
    return view('admin.editarVisita', compact('visita', 'inmuebles', 'clientes'));
}

public function update(Request $request, $id) {
    // Validación de los campos
//    $request->validate([
//        'inmueble_id' => 'required|exists:inmuebles,id', // Verifica que el inmueble exista
//        'cliente_id' => 'required|exists:clientes,id', // Verifica que el cliente exista
//        'fechaVisita' => 'required|date',
//        'horaVisita' => 'required|date_format:H:i',
//        'estado' => 'required|in:pendiente,confirmada,realizada,cancelada',
//        'observaciones' => 'nullable|string',
//        'acuerdo_pdf' => 'nullable|mimes:pdf|max:2048', // Validación del archivo PDF
//    ]);

    // Buscar el registro de la visita
    $visita = Visita::findOrFail($id);

    // Actualizar los campos manualmente
    $visita->inmueble_id = $request->inmueble_id;
    $visita->cliente_id = $request->cliente_id;
    $visita->fechaVisita = $request->fechaVisita;
    $visita->horaVisita = $request->horaVisita;
    $visita->estado = $request->estado;
    $visita->observaciones = $request->observaciones;

    // Si se sube un archivo
    if ($request->hasFile('acuerdo_pdf')) {
        $file = $request->file('acuerdo_pdf');
        $path = $file->store('acuerdos', 'public'); // Guarda el archivo en la carpeta 'acuerdos' dentro del directorio 'public'
        $visita->acuerdo_pdf = $path;
    }

    // Guardar la visita actualizada
    $visita->save();
    
        // Enviar correo al cliente
    $cliente = Cliente::findOrFail($request->cliente_id);
    \Log::info('Enviando notificación al cliente: ' . $cliente->email);
    $cliente->notify(new \App\Notifications\VisitaConfirmada($visita));

    // Redirigir al listado de visitas
    return redirect()->route('admin.visitas')->with('success', 'Visita actualizada correctamente');
}





    
    public function destroy($id) {
    DB::beginTransaction(); // Inicia una transacción para asegurar la atomicidad

    try {
        // Buscar la visita
        $visita = Visita::findOrFail($id);

        // Eliminar la visita
        $visita->delete();

        DB::commit(); // Confirma la transacción

        return redirect()->route('admin.visitas')->with('success', 'Visita eliminada con éxito');
    } catch (\Exception $e) {
        DB::rollBack(); // Deshace todos los cambios en caso de error
        return back()->with('error', 'Hubo un error al eliminar la visita.');
    }
}

}
