<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class imagenPropiedad extends Model
{
    use HasFactory;

    // Especificar el nombre correcto de la tabla
    protected $table = 'imagenes_propiedad';  // Aquí deberías usar el nombre correcto de la tabla

    protected $fillable = ['inmueble_id', 'ruta_imagen'];

    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class, 'inmueble_id');
    }
}

