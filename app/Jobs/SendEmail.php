<?php

namespace App\Jobs;

use App\Models\visita;
use App\Models\cliente;
use App\Models\inmueble;
use App\Notifications\VisitaConfirmada;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class SendEmail implements ShouldQueue
{
   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $visita;

    public function __construct(Visita $visita)
    {
        $this->visita = $visita;
    }

    public function handle()
    {
        Log::info('Job SendEmail ejecutado para la visita ID ' . $this->visita->id);

    try {
        Mail::to($this->visita->cliente->email)
            ->send(new VisitaConfirmada($this->visita));
    } catch (\Exception $e) {
        Log::error('Error enviando correo: ' . $e->getMessage());
    }
 
 
        
              //  Mail::to($this->visita->cliente->email)->send(new \App\Mail\VisitaConfirmada($this->visita));
      
        // 
        //   
        //       // Obtener cliente e inmueble relacionados
   // $cliente = $this->visita->cliente;
      //$inmueble = $this->visita->inmueble;

        // Enviar correo al cliente
  //   $cliente->notify(new VisitaConfirmada($this->visita));

        
        // Enviar correo al administrador
  Notification::route('mail', 'noelia.alafarga@gmail.com')
            ->notify(new VisitaConfirmada($this->visita));
    }
}
