<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Visita;

class SolicitudVisitaMail extends Mailable
{
    use Queueable, SerializesModels;

  
    public $user;
    public $visita;
    
     public function __construct(User $user, Visita $visita)
    {
        $this->user = $user;
        $this->visita = $visita;
    }
      public function build()
    {
        return $this->markdown('emails.visita.solicitud')
                    ->subject('📨 Nueva solicitud de visita');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Solicitud Visita Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.visita.solicitud',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
