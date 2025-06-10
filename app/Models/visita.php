<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class visita extends Model
{
        protected $fillable = [
        'inmueble_id',
        'cliente_id',
        'fechaVisita',
        'horaVisita',
        'estado',
        'observaciones',
        'acuerdo_generado',
        'acuerdo_pdf',
    ];

    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    
}
