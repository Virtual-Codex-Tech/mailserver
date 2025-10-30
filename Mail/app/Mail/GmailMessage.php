<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GmailMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $fromEmail;
    public $fromName;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $message, $fromEmail = null, $fromName = null)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $envelope = new Envelope(
            subject: $this->subject,
        );

        // Si se especifica un remitente personalizado
        if ($this->fromEmail) {
            $envelope->from($this->fromEmail, $this->fromName);
        }

        return $envelope;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.gmail-message',
            with: [
                'content' => $this->message,
            ]
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