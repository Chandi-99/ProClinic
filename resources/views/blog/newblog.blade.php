@extends('layouts.doctorlayout')
@section('content')

<main>
    <div class="container" style="margin:0 auto;">
        @if (session('alert_1'))
            <div class="alert alert-success">
                {{ session('alert_1') }}
            </div>
        @endif
        <form method="POST" action="{{ route('post.create') }}" enctype="multipart/form-data">
            @csrf
            <h6 for="image" >Create New Blog Post:</h6>
            <div class="col-lg-6 col-12 ">
            <label>Title : </label><input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="First Blog Post" required>
            
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Body : </label><textarea name="body" class="form-control form-control-lg @error('body') is-invalid @enderror" value="Body of the Blog Post" rows="7" required></textarea>
                        
            @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            </br>
            <div class="col-lg-6 col-12 ">
            <label>Add an Image : </label><input type="file" name="image" id="image" class="form-control form-control-lg  @error('body') is-invalid @enderror" required>
                        
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

</main>

@endsection