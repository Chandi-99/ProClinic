@extends('layouts.doctorlayout')
@section('content')
<section class="section-padding section-bg mt-0 pt-2">
    <div class="container pt-2" style="margin:0 auto;">
    <div class="custom-text-box  align-items-center mt-0 pt-2" style="padding-left: 50px;">
        @if (session('alert_1'))
            <div class="alert alert-danger">
                {{ session('alert_1') }}
            </div>
        @endif
        <form method="POST" action="{{ route('post.create') }}" enctype="multipart/form-data">
            @csrf
            <h6 for="image" class="text-center pt-2" >Create New Blog Post:</h6>
            <div class="col-lg-6 col-12 ">
            <strong>Title : </strong><input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="First Blog Post" required>
            
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <strong>Body : </strong><textarea name="body" class="form-control form-control-lg @error('body') is-invalid @enderror" value="Body of the Blog Post" cols="200" rows="7" required></textarea>
                        
            @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <strong>Add an Image : </strong><input type="file" name="image" id="image" class="form-control form-control-lg  @error('body') is-invalid @enderror" required>
                        
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>

            <button type="submit"  class="custom-btn mb-4">Create Post</button>
            </br>       
        </form>

    </div>
    </div>
</section>
@endsection