@extends('layouts.stafflayout')
@section('content')

<div class="container">
<h5>Create Room</h5>
    <form action="{{ route('room.create') }}" method="POST">
        @csrf
        <div>
            <label for="name" class="form-control-lg">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-lg mb-2" style="width:30%">
        </div>
        <div>
            <label for="description" class="form-control-lg mb-2">Description</label>
            <textarea name="description" id="description" class="form-control form-control-lg mb-4" style="width:50%"></textarea>
        </div>
        <button type="submit" class="custom-btn mb-4">Create Room</button>
    </form>
</div>

<div class="container">
<h5>All Rooms</h5>
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
                        <td>{{ $room->room_id }}</td>
                        <td>{{ $room->room_name }}</td>
                        <td>{{ $room->room_desc }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection