@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg mb-0 pt-1">
    <div class="container pt-4">
        <div style="text-align:center; margin-bottom:10px;">
            <a href="{{route('newNurse')}}" class="form-control custom-btn" style="display:inline-block;width:auto;background-color:#40c267;">Add New Nurse</a>
            <a href="{{route('assignNurse')}}" class="form-control custom-btn" style="display:inline-block;width:auto;background-color:#40c267;">Assign Nurse to Room</a>
        </div>

        <div class="card" style="margin:0 20%;">
            <div class="card-header" style="text-align:center;">
                <h5 style="text-align:center;">Create Room</h5>
            </div>
            <div class="card-body">

                <form action="{{ route('room.create') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="form-control-lg"><strong>Name</strong></label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg mb-2" style="width:100%">
                    </div>
                    <div>
                        <label for="description" class="form-control-lg mb-2"><strong>Description</strong></label>
                        <textarea name="description" id="description" class="form-control form-control-lg mb-4" style="width:100%"></textarea>
                    </div>
                    <button type="submit" class="custom-btn mb-4 pt-2 pb-2">Create Room</button>
                </form>
            </div>
        </div>

        <div class="row custom-text-box mt-5">
            <h5 style="text-align:center;">All Rooms</h5>
            <table id="rooms" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Room ID</th>
                        <th>Room Name</th>
                        <th>Room Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->room_name }}</td>
                        <td>{{ $room->room_desc }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</section>
@endsection