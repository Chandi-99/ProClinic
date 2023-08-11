@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg ">
    <div class="container mt-0 pt-0">
        <div class="col-12 mt-0 pt-0">
            <div class="custom-text-box mt-0 ">
                <h6 class="mb-3" class="text-center">Medicines Saved:</h6>
                <table style="border:1px solid black;" class="table table-striped table-bordered">
                    <thead>
                        <tr style="border:1px solid black;">
                            <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Name</strong></td>
                            <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Weight (mg) </strong></td>
                            <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Company</strong></td>
                            <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Availability</strong></td>
                            <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Unit Price</strong></td>
                            <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Edit/Delete</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medicines as $medi)
                        <tr>
                            <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->medi_name}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->mg}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->company}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->availability}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">Rs. {{$medi->unit_price}}</td>
                            <td style="border:1px solid black; padding:10px;" class="text-center">
                                <a href="/medicine/edit/{{ $medi->id }}" class="btn btn-primary " style="font-size:15px;font-weight:bold;">Edit</a>
                                <a href="/medicine/delete/{{ $medi->id }}" class="btn btn-danger" style="font-size:15px;font-weight:bold;">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-8 mt-3" style="margin:0px auto;">
            <div class="card">
                <form method="POST" name="form2" action="{{ route('medicine.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header" style="text-align:center;"><b>{{ __('Create New Medicine') }}</b></div>

                    <div class="card-body" style="padding-left:30px;">

                        <div class="col-lg-6 col-12 ">
                            <label>Medicine Name: </label><input type="text" name="medi_name" class="form-control form-control-lg @error('medi_name') is-invalid @enderror" style="font-size:large;" value="" required>
                            <div class="col-md-6">
                                @error('medi_name')
                                <span class="invalid-feedback" role="alert">
                                    <label>{{ $message }}</label>
                                </span>
                                @enderror
                            </div>
                        </div></br>

                        <div class="col-lg-3 col-12 ">
                            <label>Weight : (mg) </label><input type="number" name="weight" class="form-control form-control-lg @error('weight') is-invalid @enderror" style="font-size:large;" required>

                            @error('weight')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>
                        <div class="col-lg-6 col-12 ">
                            <label>Company : </label><input type="text" name="company" class="form-control form-control-lg @error('company') is-invalid @enderror" style="font-size:large;" required>

                            @error('company')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>

                        <div class="col-lg-3 col-12 ">
                            <label>Availability : </label><select type="text" name="availability" class="form-control form-control-lg @error('availability') is-invalid @enderror" style="font-size:large;">
                                <option>Available</option>
                                <option>Unavailable</option>
                            </select>

                            @error('availability')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>

                        <div class="col-lg-2 col-12 ">
                            <label>After Eat : </label><select type="text" name="after_eat" class="form-control form-control-lg @error('after_eat') is-invalid @enderror" style="font-size:large;" required>
                                <option>Yes</option>
                                <option>No</option>
                            </select>

                            @error('after_eat')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>

                        <div class="col-lg-3 col-12 ">
                            <label>Unit Price : (Rs.)</label><input type="number" name="unit_price" class="form-control form-control-lg @error('unit_price') is-invalid @enderror" style="font-size:large;" required>

                            @error('unit_price')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>

                        <div class="col-lg-10 col-12 ">
                            <label>Uses : </label><textarea name="uses" class="form-control form-control-lg @error('uses') is-invalid @enderror" style="font-size:large;" rows="5" required></textarea>

                            @error('uses')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>

                        <div class="col-lg-10 col-12 ">
                            <label>How to Use : </label><textarea name="howtouse" class="form-control form-control-lg @error('howtouse') is-invalid @enderror" style="font-size:large;" rows="5" required></textarea>

                            @error('howtouse')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>

                        <div class="col-lg-10 col-12 ">
                            <label>Precautions : </label><textarea name="precautions" class="form-control form-control-lg @error('precautions') is-invalid @enderror" style="font-size:large;" rows="5" required></textarea>

                            @error('precautions')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>

                        <div class="col-lg-10 col-12 ">
                            <label>Side Effects : </label><textarea name="side_effects" class="form-control form-control-lg @error('side_effects') is-invalid @enderror" style="font-size:large;" rows="5" required></textarea>

                            @error('side_effects')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>


                        <div class="col-lg-10 col-12 ">
                            <label>Over dose : </label><textarea name="over_dose" class="form-control form-control-lg @error('over_dose') is-invalid @enderror" style="font-size:large;" rows="5" required></textarea>

                            @error('over_dose')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>

                        <div class="col-lg-8 col-12 ">
                            <label>Image to Display : </label><input type="file" name="image" class="form-control form-control-lg @error('image') is-invalid @enderror" style="font-size:large;" required />

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <label>{{ $message }}</label>
                            </span>
                            @enderror
                        </div>
                        </br>
                        <div class="col-lg-6 col-12 align-item-center" >
                            <a href="/staff" class="btn custom-btn pt-2 pb-2">Back</a>
                            <button type="submit" name="form2" class="btn custom-btn pt-2 pb-2">Add Medicine</button>
                        </div>
                        </br>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection