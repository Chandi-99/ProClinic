@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg ">
    <div class="container mt-0 pt-0">
        <div class="col-12 mt-0 pt-0">
            <div class="custom-text-box mt-0 ">
                <h6 class="mb-3">Medicines Saved:</h6>
                <table style="border:1px solid black;" class="table table-striped table-bordered">
                    <tr style="border:1px solid black;">
                        <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Name</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center "><strong>Weight </strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Company</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Availability</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Unit Price</strong></td>
                        <td style="border:1px solid black; padding:10px;" class="text-center"><strong>Edit/Delete</strong></td>
                    </tr>
                    @foreach($medicines as $medi)
                    <tr>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->medi_name}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->mg}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->company}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->availability}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">{{$medi->unit_price}}</td>
                        <td style="border:1px solid black; padding:10px;" class="text-center">
                            <a href="/medicine/edit/{{ $medi->id }}" class="btn btn-primary " style="font-size:15px;font-weight:bold;">Edit</a>
                            <a href="/medicine/delete/{{ $medi->id }}" class="btn btn-danger" style="font-size:15px;font-weight:bold;">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="container" style="margin:0 auto;">
            <div class="custom-text-box">
                @if (session('alert_1'))
                <div class="alert alert-danger">
                    {{ session('alert_1') }}
                </div>
                @endif
                <form method="POST" name="form2" action="{{ route('medicine.update') }}" enctype="multipart/form-data">
                    @csrf
                    <h5 for="image">Create New Medicine:</h5>
                    </br>
                    <div class="col-lg-6 col-12 ">
                        <strong>Medicine Name: </strong><input type="text" name="medi_name" class="form-control form-control-lg @error('medi_name') is-invalid @enderror" value="" required>

                        @error('medi_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>
                    <div class="col-lg-6 col-12 ">
                        <strong>Weight : (mg) </strong><input type="number" name="weight" class="form-control form-control-lg @error('weight') is-invalid @enderror" value="" required>

                        @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>
                    <div class="col-lg-6 col-12 ">
                        <strong>Company : </strong><input type="text" name="company" class="form-control form-control-lg @error('company') is-invalid @enderror" value="" required>

                        @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>

                    <div class="col-lg-6 col-12 ">
                        <strong>Availability : </strong><select type="text" name="availability" class="form-control form-control-lg @error('availability') is-invalid @enderror" value="">
                            <option>Available</option>
                            <option>Unavailable</option>
                        </select>

                        @error('availability')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>

                    <div class="col-lg-6 col-12 ">
                        <strong>After Eat : </strong><select type="text" name="after_eat" class="form-control form-control-lg @error('after_eat') is-invalid @enderror" value="" required>
                            <option>Yes</option>
                            <option>No</option>
                        </select>

                        @error('after_eat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>

                    <div class="col-lg-6 col-12 ">
                        <strong>Unit Price : (Rs.)</strong><input type="number" name="unit_price" class="form-control form-control-lg @error('unit_price') is-invalid @enderror" value="" required>

                        @error('unit_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>

                    <div class="col-lg-6 col-12 ">
                        <strong>Uses : </strong><textarea name="uses" class="form-control form-control-lg @error('uses') is-invalid @enderror" value="" rows="5" required></textarea>

                        @error('uses')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>

                    <div class="col-lg-6 col-12 ">
                        <strong>How to Use : </strong><textarea name="howtouse" class="form-control form-control-lg @error('howtouse') is-invalid @enderror" value="" rows="5" required></textarea>

                        @error('howtouse')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>

                    <div class="col-lg-6 col-12 ">
                        <strong>Precautions : </strong><textarea name="precautions" class="form-control form-control-lg @error('precautions') is-invalid @enderror" value="" rows="5" required></textarea>

                        @error('precautions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>

                    <div class="col-lg-6 col-12 ">
                        <strong>Side Effects : </strong><textarea name="side_effects" class="form-control form-control-lg @error('side_effects') is-invalid @enderror" value="" rows="5" required></textarea>

                        @error('side_effects')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>


                    <div class="col-lg-6 col-12 ">
                        <strong>Over dose : </strong><textarea name="over_dose" class="form-control form-control-lg @error('over_dose') is-invalid @enderror" value="" rows="5" required></textarea>

                        @error('over_dose')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>

                    <div class="col-lg-6 col-12 ">
                        <strong>Image to Display : </strong><input type="file" name="image" class="form-control form-control-lg @error('image') is-invalid @enderror" required />

                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </br>

                    <input type="reset" style="background-color:skyblue;" class="custom-btn mb-4" />
                    <button type="submit" name="form2" class="custom-btn mb-4">Add Medicine</button>
                    </br>
                </form>

            </div>
            <div>
            </div>
</section>
@endsection