<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;  // Asegúrate de importar el modelo Cliente
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Tarifa;
use Illuminate\Support\Facades\Auth;

use IBAN; // Este es el alias de la librería globalcitizen/php-iban

class clientesController extends Controller {
    
//metodo inicio para elegir donde redirigir segun el role
public function inicio()
{
    $email = auth()->user()->email;

    // Verifica si el cliente ya está dado de alta
    $cliente = \App\Models\Cliente::where('email', $email)->first();

    if ($cliente) {
        return redirect()->route('user.inmuebles'); // Ya es cliente → inmuebles
    }

    return redirect()->route('home'); // Aún no es cliente → formulario
}



    
    
/*******FUNCIONES USUARIO***************/
    
    //alta usuario 
    public function showAltaForm()
{
    $tarifas = \App\Models\Tarifa::all();
    return view('user.home', compact('tarifas'));
}


public function listaClientesUser()
{
    // Obtener el email del usuario autenticado
    $email = Auth::user()->email;

    // Obtener los clientes cuyo email coincida con el del usuario
    $clientes = Cliente::where('email', $email)->paginate(10);

    // Devolver la vista user.clientes con los datos
    return view('user.clientes', compact('clientes'));
}


/**Procesar el alta del cliente*/
    public function alta(Request $request) {
        $request->validate([
            'tipo_cliente'   => 'required|in:física,jurídica',
            'nombre'         => 'required|string|max:100',
            'apellidos'      => 'nullable|string|max:100',
            'nif_cif'        => [
                'required', 'string', 'max:20',
                function ($attribute, $value, $fail) {
                    if (!$this->isValidNifCif($value)) {
                        $fail('El NIF o CIF no es válido.');
                    }
                }
            ],
            'telefono'       => 'required|string|max:20',
            'email'          => 'required|email|max:100',
            'direccion'      => 'required|string|max:150',
            'codigo_postal'  => 'required|string|max:10',
            'localidad'      => 'required|string|max:100',
            'provincia'      => 'required|string|max:100',
            'pais'           => 'required|string|max:100',
            'iban' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidIban($value)) {
                        $fail('El IBAN introducido no es válido.');
                    }
                },
            ],
            'tarifa_id'      => 'required|exists:tarifas,id',
            'condiciones'    => 'accepted'
        ]);

        $cliente = new Cliente();
        $cliente->tipo_cliente   = $request->tipo_cliente;
        $cliente->nombre         = $request->nombre;
        $cliente->apellidos      = $request->apellidos;
        $cliente->nif_cif        = $request->nif_cif;
        $cliente->telefono       = $request->telefono;
        $cliente->email          = $request->email;
        $cliente->direccion      = $request->direccion;
        $cliente->codigo_postal  = $request->codigo_postal;
        $cliente->localidad      = $request->localidad;
        $cliente->provincia      = $request->provincia;
        $cliente->pais           = $request->pais;
        $cliente->iban           = $request->iban;
        $cliente->fecha_alta     = now();
        $cliente->tarifa_id      = $request->tarifa_id;
        $cliente->observaciones  = 'Alta realizada desde web por el usuario autenticado.';
        $cliente->save();

        return redirect()->route('user.inmuebles')->with('success', '¡Alta realizada con éxito! Ya puedes explorar los inmuebles disponibles.');
    }

    public function updateUser(Request $request, $id) {
        $request->validate([
            'tipo_cliente' => 'required|string|max:50',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'nif_cif' => [
                'nullable', 'string', 'max:20',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidNifCif($value)) {
                        $fail('El NIF o CIF no es válido.');
                    }
                }
            ],
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'codigo_postal' => 'nullable|string|max:10',
            'localidad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',
            'iban' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidIban($value)) {
                        $fail('El IBAN introducido no es válido.');
                    }
                },
            ],
            'fecha_alta' => 'nullable|date',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->except(['email']));
            DB::commit();
            return redirect()->route('user.clientes')->with('success', 'Cliente actualizado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Hubo un error al actualizar el cliente');
        }
    }


public function verFavoritos()
{
    $inmuebles = auth()->user()->favoritos()->paginate(9);
    return view('user.favoritos', compact('inmuebles'));
}

    //MOSTRAR DETALLES
    public function showUser($id) {
        $cliente = Cliente::findOrFail($id);
        return view('user.detallesCliente', compact('cliente'));
    }
    
       public function editUser($id) {
        // Obtén el cliente por su id
        $cliente = Cliente::findOrFail($id);

        // Retorna la vista con el cliente a editar
        return view('user.editarClienteUser', compact('cliente'));
    }





/*********** FUNCIONES ADMIN ******************/

    // Función para listar los clientes
    public function listaClientes() {
        // Obtener todos los clientes, puedes modificar esto si necesitas paginación o filtros
    $clientes = Cliente::paginate(10);
        // Pasar los datos a la vista admin.clientes
        return view('admin.clientes', compact('clientes'));
    }

    // mostrar el formulario de creación
    public function create() {
        return view('admin.nuevoCliente');
    }
    
    //alta cliente admin
    
       public function store(Request $request) {
        $request->validate([
            'tipo_cliente' => 'required|string|max:50',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'nif_cif' => [
                'nullable', 'string', 'max:20',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidNifCif($value)) {
                        $fail('El NIF o CIF no es válido.');
                    }
                },
            ],
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'codigo_postal' => 'nullable|string|max:10',
            'localidad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',
            'iban' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidIban($value)) {
                        $fail('El IBAN introducido no es válido.');
                    }
                },
            ],
            'fecha_alta' => 'nullable|date',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        Cliente::create([
            'tipo_cliente'   => $request->tipo_cliente,
            'nombre'         => $request->nombre,
            'apellidos'      => $request->apellidos,
            'nif_cif'        => $request->nif_cif,
            'telefono'       => $request->telefono,
            'email'          => $request->email,
            'direccion'      => $request->direccion,
            'codigo_postal'  => $request->codigo_postal,
            'localidad'      => $request->localidad,
            'provincia'      => $request->provincia,
            'pais'           => $request->pais,
            'iban'           => $request->iban,
            'fecha_alta'     => $request->fecha_alta,
            'observaciones'  => $request->observaciones,
        ]);

        return redirect()->route('admin.clientes')->with('success', 'Cliente creado con éxito');
    }

    //MOSTRAR DETALLES
    public function showAdmin($id) {
        $cliente = Cliente::findOrFail($id);
        return view('admin.detallesCliente', compact('cliente'));
    }

    public function edit($id) {
        // Obtén el cliente por su id
        $cliente = Cliente::findOrFail($id);

        // Retorna la vista con el cliente a editar
        return view('admin.editarCliente', compact('cliente'));
    }


     public function update(Request $request, $id) {
        $request->validate([
            'tipo_cliente' => 'required|string|max:50',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'nullable|string|max:255',
            'nif_cif' => [
                'nullable', 'string', 'max:20',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidNifCif($value)) {
                        $fail('El NIF o CIF no es válido.');
                    }
                },
            ],
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'codigo_postal' => 'nullable|string|max:10',
            'localidad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',
            'iban' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !$this->isValidIban($value)) {
                        $fail('El IBAN introducido no es válido.');
                    }
                },
            ],
            'fecha_alta' => 'nullable|date',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->except(['email']));
            DB::commit();
            return redirect()->route('admin.clientes')->with('success', 'Cliente actualizado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Hubo un error al actualizar el cliente');
        }
    }

    public function destroy($id) {
        DB::beginTransaction(); // Inicia una transacción para asegurar la atomicidad

        try {
            // Buscar el cliente
            $cliente = Cliente::findOrFail($id);

            // Eliminar el cliente (se pueden agregar más eliminaciones si el cliente tiene relaciones)
            $cliente->delete();

            DB::commit(); // Confirma la transacción

            return redirect()->route('admin.clientes')->with('success', 'Cliente eliminado con éxito');
        } catch (\Exception $e) {
            DB::rollBack(); // Deshace todos los cambios en caso de error
            return back()->with('error', 'Hubo un error al eliminar el cliente.');
        }
    }
    
    
     /***********VALIDACIONES**************/
    
        private function isValidNifCif($valor) {
        $valor = strtoupper(trim($valor));
        if (preg_match('/^[0-9]{8}[A-Z]$/', $valor)) {
            $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
            $numero = substr($valor, 0, 8);
            return $valor[8] === $letras[$numero % 23];
        }
        if (preg_match('/^[A-Z][0-9]{7}[A-Z0-9]$/', $valor)) {
            return true;
        }
        return false;
    }
    
   
    
    private function isValidIban($iban)
{
    $iban = strtolower(str_replace(' ', '', $iban));
    $countries = [
        'al'=>28,'ad'=>24,'at'=>20,'az'=>28,'bh'=>22,'be'=>16,'ba'=>20,'br'=>29,'bg'=>22,
        'cr'=>21,'hr'=>21,'cy'=>28,'cz'=>24,'dk'=>18,'do'=>28,'ee'=>20,'fo'=>18,'fi'=>18,
        'fr'=>27,'ge'=>22,'de'=>22,'gi'=>23,'gr'=>27,'gl'=>18,'gt'=>28,'hu'=>28,'is'=>26,
        'ie'=>22,'il'=>23,'it'=>27,'jo'=>30,'kz'=>20,'kw'=>30,'lv'=>21,'lb'=>28,'li'=>21,
        'lt'=>20,'lu'=>20,'mk'=>19,'mt'=>31,'mr'=>27,'mu'=>30,'mc'=>27,'md'=>24,'me'=>22,
        'nl'=>18,'no'=>15,'pk'=>24,'ps'=>29,'pl'=>28,'pt'=>25,'qa'=>29,'ro'=>24,'sm'=>27,
        'sa'=>24,'rs'=>22,'sk'=>24,'si'=>19,'es'=>24,'se'=>24,'ch'=>21,'tn'=>24,'tr'=>26,
        'ae'=>23,'gb'=>22,'vg'=>24
    ];

    $chars = [
        'a'=>10,'b'=>11,'c'=>12,'d'=>13,'e'=>14,'f'=>15,'g'=>16,'h'=>17,'i'=>18,'j'=>19,
        'k'=>20,'l'=>21,'m'=>22,'n'=>23,'o'=>24,'p'=>25,'q'=>26,'r'=>27,'s'=>28,'t'=>29,
        'u'=>30,'v'=>31,'w'=>32,'x'=>33,'y'=>34,'z'=>35
    ];

    if (strlen($iban) < 4) return false;
    $country = substr($iban, 0, 2);

    if (!array_key_exists(strtolower($country), $countries)) return false;
    if (strlen($iban) != $countries[strtolower($country)]) return false;

    $moved = substr($iban, 4) . substr($iban, 0, 4);
    $newiban = '';

    foreach (str_split($moved) as $char) {
        if (is_numeric($char)) {
            $newiban .= $char;
        } elseif (array_key_exists($char, $chars)) {
            $newiban .= $chars[$char];
        } else {
            return false;
        }
    }

    return bcmod($newiban, '97') == 1;
}


}
