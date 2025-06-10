<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class cliente extends Model {
    
       use Notifiable;
       
           // Aquí defines la ruta del correo
 /*   public function routeNotificationForMail()
    {
        return $this->email;
    }
  * 
  */

    // Especifica la tabla (opcional si el nombre coincide con la convención en plural)
    protected $table = 'clientes';
    // Campos que pueden ser asignados en masa (por ejemplo, con Cliente::create($datos))
    protected $fillable = [
        'tipo_cliente',
        'nombre',
        'apellidos',
        'nif_cif',
        'telefono',
        'email',
        'direccion',
        'codigo_postal',
        'localidad',
        'provincia',
        'pais',
        'iban',
        'fecha_alta',
        'observaciones',
    ];
    // Si tienes campos de fecha personalizados, puedes añadirlos aquí
    protected $dates = ['fecha_alta'];
    // Opcional: puedes activar timestamps si tu tabla tiene `created_at` y `updated_at`
    public $timestamps = true;

    // Cliente.php
    public function visitas() {
        return $this->hasMany(Visita::class);  // Asumiendo que tienes un modelo Visita
    }

// Cliente.php
    public function compras() {
        return $this->hasMany(Compra::class);  // Asumiendo que tienes un modelo Compra
    }

// Cliente.php
    public function contratos() {
        return $this->hasMany(Contrato::class);  // Asumiendo que tienes un modelo Contrato
    }

// Cliente.php
    public function facturas() {
        return $this->hasMany(Factura::class);  // Asumiendo que tienes un modelo Factura
    }
    
    public function tarifa()
{
    return $this->belongsTo(Tarifa::class);
}

public function getIbanFormateadoAttribute()
{
    return trim(chunk_split(strtoupper($this->iban), 4, ' '));
}


}
