@component('mail::message')
# New Room Assignment Alert!

Dear {{$fname}},

We hope this message finds you well. We are writing to inform you about your upcoming assignment in our medical center.

Assignment Details:

<strong>Name: </strong> {{$fname}} {{$lname}}

<strong>Date: </strong>{{$date}}

<strong>Session: </strong>{{$session}}

<strong>Start time: </strong>{{$time}}

<strong>Room: </strong>{{$roomname}}


Your dedication and commitment to patient care are truly appreciated, and we believe you will excel in your responsibilities during this assignment.

Please ensure you are well-prepared for your shift, and kindly confirm your availability for this assignment at your earliest convenience. If you have any concerns or require any additional information, please don't hesitate to reach out to the nursing supervisor or your immediate manager.

Thank you for your hard work and dedication to providing exceptional care to our patients. We look forward to your contributions on {{$date}}.

Best regards,

HR Team
ProClinic Medical Center

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
ProClinic Website
@endcomponent

@endcomponent