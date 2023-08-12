@extends('layouts.doctorlayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-5">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;"><b>{{ __('Add New Patient Allergy') }}</b></div>
                    <div class="card-body">
                        <form method="POST" name="form1" action="/newAllergy/{{$patientId}}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Allergy ') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('allergy') is-invalid @enderror" name="allergy"  autocomplete="allergy" required>
                                    @error('allergy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>
                                <div class="col-md-6">
                                    <select type="text" class="form-control @error('status') is-invalid @enderror" name="status" autocomplete="status" required>
                                        <option selected>Immediate Hypersensitivity</option>
                                        <option>Cytotoxic Hypersensitivity</option>
                                        <option>Immune Complex-Mediated Hypersensitivity</option>
                                        <option>Delayed Hypersensitivity</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div style="margin:0px auto;" class="item-align-center">
                                <center>
                                    <button type="submit" style="margin:0px auto;" class="custom-btn pt-1 pb-1">
                                        {{ __('Submit') }}
                                    </button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 custom-text-box">
            <h5 style="text-align:center;">Allergies of the Patient</h5>
            <table id="rooms" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Allergy Name</th>
                        <th class="text-center">Category</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($allergies))
                    @foreach($allergies as $allergy)
                    <tr>
                        <td class="text-center">{{ $allergy->allergy }}</td>
                        <td class="text-center">{{ $allergy->status }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection