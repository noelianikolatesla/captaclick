<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class inmueble extends Model
{
    use HasFactory;

protected $fillable = [
    'titulo',
    'tipo_operacion',
    'tipo_vivienda',
    'calle',
    'numero',
    'codigo_postal',
    'poblacion',
    'provincia',
    'm2',
    'habitaciones',
    'banos',
    'terraza',
    'garaje',
    'piscina',
    'precio',
    'precio_m2',
    'estado',
    'zona',
    'propietario',
    'telefono',
    'observaciones',
    'descripcion',
    'disponible' // 👈 ESTE TE FALTABA
];


//casting automatico
protected $casts = [
    'disponible' => 'boolean',
    'terraza' => 'boolean',
    'garaje' => 'boolean',
    'piscina' => 'boolean',
];


    // Relación con las imágenes
    public function imagenPropiedad()
    {
        return $this->hasMany(ImagenPropiedad::class, 'inmueble_id');
    }
    
    public function usuariosQueLoFavoritaron()
{
    return $this->belongsToMany(User::class, 'favoritos')->withTimestamps();
}

}

