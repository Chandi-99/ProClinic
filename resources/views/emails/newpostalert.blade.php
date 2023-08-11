@component('mail::message')
# New Blog Post Alert!

Dear {{$email->email}},

New Blog Post has Posted in the Blog.

Post Details:

<strong>Title: </strong> {{$title}} 

<strong>Date: </strong>{{$date}}

<strong>Time: </strong>{{$time}}

HR Team

ProClinic Medical Center

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
ProClinic Website
@endcomponent

@endcomponent