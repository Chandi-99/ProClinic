<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PatientAppointment extends Mailable
{
    use Queueable, SerializesModels;
    public $email, $doctorFees, $billid, $prescriptionid;
    public $id, $patientName, $doctorName, $date, $session, $startTime, $AppointmentNumber, $type;

    /**
     * Create a new message instance.
     */
    public function __construct($id, $email,$patientName, $type,$doctorName,$date, $session, $startTime, $AppointmentNumber, $doctorFees, $billid, $prescriptionid)
    {
        $this->id = $id;
        $this->email = $email;
        $this->type = $type;
        $this->patientName = $patientName;
        $this->doctorName = $doctorName;
        $this->date = $date;
        $this->session = $session;
        $this->startTime = $startTime;
        $this->AppointmentNumber = $AppointmentNumber;
        $this->doctorFees = $doctorFees;
        $this->prescriptionid = $prescriptionid;
        $this->billid = $billid;
    }

    public function build()
    {
        return $this
            ->subject('Appointment Created Successfully!')
            ->markdown('emails.patientappointment');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.patientappointment',
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
