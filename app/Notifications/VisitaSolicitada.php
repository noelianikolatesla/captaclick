<?php

namespace App\Notifications;

use App\Models\Visita;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VisitaSolicitada extends Notification
{
    use Queueable;

    public $visita;

    public function __construct(Visita $visita)
    {
        $this->visita = $visita;
    }

    public function via($notifiable)
    {
        return ['mail']; // Si quieres guardar también en base de datos: ['mail', 'database']
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nueva solicitud de visita')
            ->greeting('Hola ' . $notifiable->nombre)
            ->line('Has solicitado una visita para el inmueble: ' . $this->visita->inmueble->titulo)
            ->line('Fecha: ' . $this->visita->fechaVisita)
            ->line('Hora: ' . $this->visita->horaVisita)
            ->action('Ver inmueble', url('/user/inmuebles/' . $this->visita->inmueble->id))
            ->line('Gracias por confiar en CaptaClik.');
    }

    // Si deseas guardar notificación en base de datos:
    public function toArray($notifiable)
    {
        return [
            'visita_id' => $this->visita->id,
            'inmueble' => $this->visita->inmueble->titulo,
            'fecha' => $this->visita->fechaVisita,
            'hora' => $this->visita->horaVisita,
        ];
    }
}
