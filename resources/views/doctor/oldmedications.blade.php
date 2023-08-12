@extends('layouts.doctorlayout')
@section('content')

<section class="section-padding section-bg mb-0 pt-1">
    <div class="container pt-0 mt-0">
        <h5 class="text-center pt-0 mt-0" style="color:black; font-weight:700; font-size:25px;"> Patient's Old Medication Records</h5>
        <div class="row justify-content-center mb-4 mb-4">
            <div class="col-md-8">
                <ol>
                @foreach($result as $result)
                    <li>{{$result}}</li>
                @endforeach
                </ol>     
            </div>
        </div>
    </div>
</section>
