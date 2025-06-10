<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tarifa;

class TarifaSeeder extends Seeder
{
    public function run()
    {
        Tarifa::create(['nombre' => 'Demo', 'precio' => 0.00, 'descripcion' => 'Prueba gratuita durante 7 días.']);
        Tarifa::create(['nombre' => 'Estándar', 'precio' => 50.00, 'descripcion' => 'Sin permanencia, acceso para 3 usuarios.']);
        Tarifa::create(['nombre' => 'PRO', 'precio' => 100.00, 'descripcion' => 'Incluye todo, hasta 10 usuarios.']);
    }
}