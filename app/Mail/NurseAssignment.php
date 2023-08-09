<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NurseAssignment extends Mailable
{
    use Queueable, SerializesModels;
    public $email, $fname, $lname, $date, $time, $roomname, $session;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $fname, $lname, $date, $time, $roomname, $session)
    {
        $this->email = $email;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->date = $date;
        $this->time = $time;
        $this->roomname = $roomname;
        $this->session = $session;
    }

    public function build()
    {
        return $this
            ->subject('New Room Assignment')
            ->markdown('emails.nurseassignment');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Room Assignment',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.nurseassignment',
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
