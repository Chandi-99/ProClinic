<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewPostAlert extends Mailable
{
    use Queueable, SerializesModels;
    public $email, $title, $date, $time;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $title, $date, $time)
    {
        $this->email = $email;
        $this->title = $title;
        $this->date = $date;
        $this->time = $time;
    }

    public function build()
    {
        return $this
            ->subject('New Blog Post Alert!')
            ->markdown('emails.newpostalert');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Blog Post',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.newpostalert',
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
