<?php
// Asegúrate que esto está dentro del archivo
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;


class SendOtpCodeMain extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public int $code)
    {    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: __('Tu código de verificación'));
    }

    public function content(): Content
    {
        return new Content(view: 'emails.otp-code', // Esta es la vista que creaste
            with: ['code'=>$this->code], // Pasas el valor a la vista
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

?>
