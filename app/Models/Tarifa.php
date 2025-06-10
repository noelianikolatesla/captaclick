<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Tarifa extends Model
{
      use HasFactory;

    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
