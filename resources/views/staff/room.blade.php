@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-1">
    <div class="container pt-4">
        <div style="text-align:center; margin-bottom:10px;">
            <a href="{{route('newNurse')}}" class="form-control custom-btn pt-2 pb-2" style="display:inline-block;width:auto;background-color:#40c267;">Add New Nurse</a>
            <a href="{{route('assignNurse')}}" class="form-control custom-btn pt-2 pb-2 mb-4" style="display:inline-block;width:auto;background-color:#40c267;">Assign Nurse to Room</a>
        </div>

        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center;"><b>{{ __('Create Room') }}</b></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('room.create') }}">
                            @csrf
                            <div class="row mb-3 mt-2">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name for the Room: ') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="fname" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid Room Name</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Room Description') }}</label>
                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Invalid Description.</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a type="reset" href="/staff" class="custom-btn pt-1 pb-1">
                                        {{ __('Back') }}
                                    </a>
                                    <button type="submit" class="custom-btn pt-1 pb-1">
                                        {{ __('Create Room') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row custom-text-box " style="margin:30px;">
        <h5 style="text-align:center;">All Rooms</h5>
        <table id="rooms" class="table table-striped table-bordered">
            <thead>
                <tr style="text-align:center;">
                    <th>Room ID</th>
                    <th>Room Name</th>
                    <th>Room Description</th>
                    <th>Number of Sessions Registered for that Room</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr style="text-align:center;">
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->room_name }}</td>
                    <td>{{ $room->room_desc }}</td>
                    <td>{{ $room->visitings_count}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</section>
@endsection