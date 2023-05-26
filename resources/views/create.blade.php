@extends('layouts.app')
@section('content')

<main>
<h1>Create Appointment</h1>
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <form method="POST" action="{{ route('appointments') }}">
        @csrf
        <div>
            <label>Doctor:</label>
            <select name="doctor_id">
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }} - {{ $doctor->specialty }}</option>
                @endforeach
            </select>
        </div>
</main>
        
        
@endsection