@extends('layouts.app')
@section('content')

<section class="section-padding section-bg ">
    <div class="container ">
        <div class="col-12 ">
            <div class="custom-text-box ">
                <div class="col-lg-5 col-12 mb-5">
                    <form method="POST" action="{{route('searchmedi')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" placeholder="Medicine Name " name="medicine_name" class="form-control form-control-lg" required/>
                        </br>
                        <button type="submit" class="custom-btn pt-1 pb-1" name="form1">Search</button>
                    </form>
                </div>
                <h4 class="mb-3">The Medicine You Search Found!</h4>
                <table>
                    <tr>
                        <td><strong>Name: </strong> </td>
                        <td class="text-primary">{{ $medi[0]->medi_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Weight: </strong></td>
                        <td class="text-info">{{ $medi[0]->mg }}mg</td>
                    </tr>
                    <tr>
                        <td><strong>Company: </strong> </td>
                        <td>{{ $medi[0]->company }}</td>
                    </tr>
                    @if($medi[0]->availability == 'Available')
                    <tr>
                        <td><strong>Availability: </strong></td>
                        <td class="text-success">{{ $medi[0]->availability }}</td>
                    </tr>
                    @else
                    <tr>
                        <td><strong>Availability: </strong></td>
                        <td class="text-danger">{{ $medi[0]->availability }}</td>
                    </tr>
                    <tr>
                        @endif
                        <td><strong>After Eat: </strong></td>
                        <td>{{ $medi[0]->after_eat }}</td>
                    </tr>
                    <tr>
                        <td><strong>Unit Price: </strong> </td>
                        <td>{{ $medi[0]->unit_price }}</td>
                    </tr>
                    <tr>
                        <td><strong>Uses: </strong> </td>
                        <td>{{ $medi[0]->uses }}</td>
                    </tr>
                    <tr class="mb-4">
                        <td><strong>How to Use: </strong> </td>
                        <td>{{ $medi[0]->howtouse }}</td>
                    </tr>
                    <tr class="mb-4">
                        <td><strong>Precautions: </strong></td>
                        <td>{{ $medi[0]->precautions }}</td>
                    </tr>
                    <tr class="mb-4">
                        <td><strong>Side Effects: </strong></td>
                        <td>{{ $medi[0]->side_effects }}</td>
                    </tr>
                    <tr class="mb-4">
                        <td><strong>Overdose: </strong></td>
                        <td>{{ $medi[0]->overdose }}</td>
                    </tr>
                    <tr class="mb-4">
                        <td><strong>Image: </strong></td>
                        <td><img src="{{ url('public/MediImages/'.$medi[0]->image) }}" style="width:300px; height:400px;" z-index='0' /></td>
                    </tr>
                </table>
            </div>
            <a class="custom-btn pt-1 pb-1" href="{{route('welcome')}}">Go Back</a>
        </div>
    </div>

    @endsection