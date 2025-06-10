<?php

namespace App\Notifications;

//use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\visita;

class VisitaConfirmada extends Notification {

   // use Queueable;

    public $visita;

    public function __construct(visita $visita) {
        $this->visita = $visita;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
public function toMail(object $notifiable): MailMessage {
    return (new MailMessage)
        ->subject('Confirmación de Visita')
->view('admin.emails.visita_confirmada', ['visita' => $this->visita]);
    
//        ->subject('Confirmación de Visita')
//        ->greeting('Hola ' . $notifiable->nombre)
//        ->line('Tu visita ha sido confirmada.')
//        ->line('Inmueble: ' . $this->visita->inmueble->titulo)
//        ->line('Fecha: ' . $this->visita->fechaVisita)
//        ->line('Hora: ' . $this->visita->horaVisita)
//        ->line('Gracias por confiar en CaptaClik.');
}
   
    

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
                //
        ];
    }
}
