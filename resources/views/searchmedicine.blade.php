@extends('layouts.app')
@section('content')

<main>
<section class="section-padding section-bg ">
    <div class="container ">
        <div class="col-12 ">
            <div class="custom-text-box ">
                    <h4 class="mb-3 ">The Medicine You Search Found!</h4>
                    <table>     
                        <tr>
                            <td><strong>Name:   </strong>  </td><td>{{ $medi[0]->medi_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Weight:     </strong></td><td>{{ $medi[0]->mg }}mg</td>
                        </tr>
                        <tr>
                            <td><strong>Company Make:   </strong> </td><td>{{ $medi[0]->company }}</td>
                        </tr>
                        <tr>
                            <td><strong>Availability:   </strong></td><td>{{ $medi[0]->availability }}</td>
                        </tr>
                        <tr>
                            <td><strong>After Eat:  </strong></td><td>{{ $medi[0]->after_eat }}</td>
                        </tr>
                        <tr>
                            <td><strong>Unit Price:</strong> </td><td>{{ $medi[0]->unit_price }}</td>
                        </tr>
                        <tr>
                            <td><strong>Uses:   </strong> </td><td>{{ $medi[0]->uses }}</td>
                        </tr>
                        <tr>
                            <td><strong>Side Effects:   </strong></td><td>{{ $medi[0]->side_effects }}</td>
                        </tr>
                    </table>   
            </div>
            <a class="custom-btn" href="{{route('welcome')}}" >Go Back</a>
        </div>
    </div>
</main>

@endsection