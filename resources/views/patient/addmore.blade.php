@extends('layouts.app')
@section('content')
<section class="section-padding section-bg mb-0 pt-5">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;"><b>{{ __('Add More Details About You') }}</b></div>
                    <div class="card-body">
                        <form method="POST" name="form1" action="/addmore/{{Auth::user()->id}}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Civil Status') }}</label>
                                <div class="col-md-6">
                                    <select type="text" class="form-control @error('civil_status') is-invalid @enderror" style="width:50%;" name="civil_status" autocomplete="civil_status" required>
                                        <option>Single</option>
                                        <option selected>Married</option>
                                    </select>
                                    @error('civil_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Occupation') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation"  autocomplete="occupation" required>
                                    @error('occupation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Blood Group') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('blood_group') is-invalid @enderror" style="width:50%;" name="blood_group" autocomplete="blood_group">
                                    @error('blood_group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Last Exam') }}</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" style="width:50%;" name="date" autocomplete="date">
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Height') }} (cm)</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control @error('height') is-invalid @enderror" name="height" style="width:50%;" autocomplete="height">
                                    @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Weight') }} (Kg)</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" style="width:50%;" autocomplete="weight">
                                    @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Smoking') }}</label>
                                <div class="col-md-6">
                                    <select type="text" class="form-control @error('smoking') is-invalid @enderror" name="smoking" style="width:50%;" autocomplete="smoking">
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                    @error('smoking')
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
    </div>
</section>
@endsection