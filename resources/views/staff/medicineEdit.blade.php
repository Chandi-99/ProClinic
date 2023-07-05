@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-0">
    <div class="container pt-0 mt-0">
            <div class="custom-text-box mt-0">
            @foreach($medicines as $medicine)
            <form method="POST" name="form2" action="/medicine/edit/{{ $medicine->id }}" enctype="multipart/form-data">
            @csrf
            <h5 for="image" >Create New Medicine:</h5>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Medicine Name: </label><input type="text" name="medi_name" class="form-control form-control-lg @error('medi_name') is-invalid @enderror" value="{{$medicine->medi_name}}" readonly>
            
            @error('medi_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Weight : (mg) </label><input type="number" name="weight" class="form-control form-control-lg @error('weight') is-invalid @enderror" value="{{$medicine->mg}}" required>
            
            @error('weight')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Company : </label><input type="text" name="company" class="form-control form-control-lg @error('company') is-invalid @enderror" value="{{$medicine->company}}" required>
            
            @error('company')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <div class="col-lg-6 col-12 ">
            <label>Availability : </label><select name="availability" class="form-control form-control-lg @error('availability') is-invalid @enderror" value="{{$medicine->availability}}" required>
                @if($medicine->availability == 'Available')
                    <option selected>Available</option>
                    <option>Unavailable</option>
                @else
                    <option selected>Unavailable</option>
                    <option>Available</option>
                @endif
            </select>
            
            @error('availability')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <div class="col-lg-6 col-12 ">
            <label>After Eat : </label><select  name="after_eat" class="form-control form-control-lg @error('after_eat') is-invalid @enderror" value="{{$medicine->after_eat}}" required>
                @if($medicine->after_eat == 'Yes')
                    <option selected>Yes</option>
                    <option>No</option>
                @else
                    <option selected>No</option>
                    <option>Yes</option>
                @endif
            </select>
            
            @error('after_eat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <div class="col-lg-6 col-12 ">
            <label>Unit Price : (Rs.)</label><input type="number" name="unit_price" class="form-control form-control-lg @error('unit_price') is-invalid @enderror" value="{{$medicine->unit_price}}" required>
            
            @error('unit_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <div class="col-lg-6 col-12 ">
            <label>Uses : </label><textarea name="uses" class="form-control form-control-lg @error('uses') is-invalid @enderror" value="" rows="5" required>{{$medicine->uses}}</textarea>
            
            @error('uses')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <div class="col-lg-6 col-12 ">
            <label>How to Use : </label><textarea name="howtouse" class="form-control form-control-lg @error('howtouse') is-invalid @enderror" value="" rows="5" required>{{$medicine->howtouse}}</textarea>
            
            @error('howtouse')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <div class="col-lg-6 col-12 ">
            <label>Precautions : </label><textarea name="precautions" class="form-control form-control-lg @error('precautions') is-invalid @enderror" value="" rows="5" required>{{$medicine->precautions}}</textarea>
            
            @error('precautions')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <div class="col-lg-6 col-12 ">
            <label>Side Effects : </label><textarea name="side_effects" class="form-control form-control-lg @error('side_effects') is-invalid @enderror" value="" rows="5" required>{{$medicine->side_effects}}</textarea>
            
            @error('side_effects')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            
            <div class="col-lg-6 col-12 ">
            <label>Over dose : </label><textarea name="over_dose" class="form-control form-control-lg @error('over_dose') is-invalid @enderror" value="" rows="5" required>{{$medicine->overdose}}</textarea>
            
            @error('over_dose')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>
            </br>
            <input type="reset" class="custom-btn mb-4"/>
            <button type="submit"  class="custom-btn mb-4">Update Medicine</button>
            </br>       
        </form>
        @break
        @endforeach
    </div>
</section>
@endsection