@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg mt-0 pt-2">
    <div class="container ">
        <div class="custom-text-box  align-items-center mt-0 pt-2" style="padding-left: 50px;">
            <h6 class="text-center" style="font-size:larger;">Create Doctor Appointment</h6>
            <div id="id_1" class="mt-3">
                <div class="row">
                    <p><span style="font-weight:bold; font-size:large;">Patient Name: </span> {{$patient[0]->fname }} {{$patient[0]->lname}}</p>
                    <p><span style="font-weight:bold; font-size:large;">Doctor Name: </span>{{$doctor[0]->fname}} {{$doctor[0]->lname}}</p>
                    <p><span style="font-weight:bold; font-size:large;">Type: </span>{{$type}}</p>
                    <p class="alert alert-info">Doctor Only Available in Following Days: <span style="color:red;font-weight:bold;">{{$days}}</span></p>
                </div>
                <form method="POST" name="form1">
                    @csrf
                    <div class="col-lg-6 col-12 ">
                        @if (session('alert_2'))
                        <div class="alert alert-info">
                            {{ session('alert_2') }}
                        </div>
                        @endif
                        @if (session('alert_3'))
                        <div class="alert alert-danger" style="font-size:small;">
                            {{ session('alert_3') }}
                        </div>
                        @endif
                        <label style="font-weight:bold; font-size:large;">Appointment Date:</label>
                        <input type="date" id='date' name="date" class="form-control form-control-lg @error('date') is-invalid @enderror" style="width:50%" value="{{$date}}" required {{ $isReadOnly ? '' : 'disabled' }} />
                        <button type="submit" name="form1" class="btn btn-dark pt-1 pb-1 mb-2 mt-2" style="display:inline-flex;" {{ $isReadOnly ? '' : 'disabled' }}>Check Available Sessions</button>
                </form>

                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <form method="POST" name="form2">
                    @csrf
                    <strong style="font-weight:bold; font-size:large;">Available Sessions:</strong>
                    <select name="session" class="form-control form-control-lg @error('session') is-invalid @enderror mb-1" style="width:50%;" {{ $isReadOnly ? 'disabled' : '' }}>
                    @foreach ($sessions as $value)
                        @if ($value == 'morning_true')
                            <option value="Morning">Morning</option>
                            @continue
                        @endif
                        @if ($value == 'afternoon_true')
                            <option value="Afternoon">Afternoon</option>
                            @continue
                        @endif
                        @if ($value == 'evening_true')
                            <option value="Evening">Evening</option>
                            @continue
                        @endif
                        @if ($value == 'night_true')
                            <option value="Night">Night</option>
                            @continue
                        @endif
                    @endforeach
                    </select>
                    @error('session')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="date" name="hiddendate" value="{{$date}}" hidden />
                    <button type="submit" name="form2" class="custom-btn pt-2 pb-2 mt-2" {{ $isReadOnly ? 'disabled' : '' }}>Make Appointment</button>
                </form>
            </div>
            </br>
        </div>
    </div>
    </div>
</section>
@endsection