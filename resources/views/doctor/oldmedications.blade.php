@extends('layouts.doctorlayout')
@section('content')

<section class="section-padding section-bg mb-0 pt-1">
    <div class="container pt-0 mt-0">
        <h5 class="text-center pt-0 mt-0" style="color:black; font-weight:700; font-size:25px;"> Patient's Old Medication Records</h5>
        <div class="row justify-content-center mb-4 mb-4 custom-text-box">
            <div class="col-md-8">
            <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th width="20%">Date</th>
                                <th width="40%">Medicine</th>
                                <th>Dose</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                @if(isset($latests))
                                @foreach($latests as $latest)
                                @foreach($latest->Prescription() as $value)
                                <td width="30%">{{$latest->date}}</td>
                                <td width="10%">{{$value->MedicineName()}}</td>
                                <td>{{$value->dose}}</td>
                                @endforeach
                                @endforeach
                                @endif
                            </tr>
                        </tbody>
                    </table>   
            </div>
            
        </div>
        <a href="{{ url()->previous() }}"  class="btn custom-btn pt-1 pb-1">Back</a>
    </div>
</section>
@endsection
