@component('mail::message')
# New Appointment Alert!

Dear Doctor {{$email}},

I hope this email finds you well. I wanted to inform you that a new appointment has been scheduled for your attention. Below are the details:

<strong>Appointment Id: </strong>{{$id}}

<strong>Patient Name: </strong>{{$patientName}}

<strong>Doctor Name: </strong>{{$doctorName}}

<strong>Date: </strong>{{$date}}

<strong>Appointment Type: </strong>{{$type}}

<strong>Session: </strong>{{$session}}

<strong>Start Time: </strong>{{$startTime}}

<strong>Appointment Number: </strong>{{$AppointmentNumber}}

<strong>Amount Paid: </strong>{{$doctorFees}}

<strong>Bill Id: </strong>{{$billid}}

<strong>Prescription Id: </strong>{{$prescriptionid}}

<strong>Note:</strong>Please check your mobile to keep updated.

Should you require any further information or have any specific requirements for this appointment, please let us know, and we will be happy to assist you.

Thank you for your attention to this matter. We appreciate your commitment to providing excellent care to our patients.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
ProClinic Website
@endcomponent

Thanks,<br>
{{ _('ProClinic Medical Center') }}
@endcomponent