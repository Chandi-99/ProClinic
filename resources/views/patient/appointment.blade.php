@extends('layouts.app')

@section('content')
<section class="section-padding section-bg mt-0 pt-2">
    <div class="container ">
        <div class="row" >
            <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0 " style="background-color:white;">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="/oldappointments/{{Auth::user()->id}}" class="d-block " style="text-decoration:none;">
                        <img src="/images/test1.png " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">

                        <p class="featured-block-text " style="text-decoration:none;">View <strong>Old Appointments</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0 " style="background-color:white;">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="/incomingappointments/{{Auth::user()->id}}" class="d-block " style="text-decoration:none;">
                        <img src="/images/test2.png " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">

                        <p class="featured-block-text " style="text-decoration:none;">View <strong>Incoming Appointments</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0 " style="background-color:white;">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="/chat" class="d-block " style="text-decoration:none;">
                        <img src="/images/test3.png " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">

                        <p class="featured-block-text " style="text-decoration:none;">Talk to a <strong>Staff Member</strong></p>
                    </a>
                </div>
            </div>
        </div>
        </br>
        </br>
        @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <p>{{ Session::get('success') }}</p>
        </div>
        @endif
        <div class="custom-text-box  align-items-center mt-0 pt-2" style="padding-left: 50px;">
            <h6 class="text-center pt-2" style="font-size:larger;">Create Doctor Appointment</h6>
            <form method="POST" action="/newappointment/{{Auth::user()->id}}">
                @csrf
                <div class="col-lg-6 col-12">
                    @if (session('alert_1'))
                    <div class="alert alert-danger">
                        {{ session('alert_1') }}
                    </div>
                    @endif
                    <strong> Doctor: </strong>
                    <input type="text" id="doctorInput" name="doctor" class="form-control form-control-lg @error('doctor') is-invalid @enderror" placeholder="Type doctor's name..." required {{ $isReadonly ? 'disabled' : '' }}>
                    <select id="doctorSelect" name="doctor" class="form-control form-control-lg" style="display: none;" {{ $isReadonly ? 'disabled' : '' }}>

                    </select>
                    @error('doctor')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                </br>

                <div class="col-lg-6 col-12 ml-10">
                    <strong> Speciality: </strong>
                    <select name="speciality" class="form-control form-control-lg @error('speciality') is-invalid @enderror" {{ $isReadonly ? 'disabled' : '' }}>
                        @foreach($specialities as $speciality)
                        @if($selectedDoctorSpeciality == $speciality)
                        <option selected>{{$speciality->specialization}}</option>
                        @else
                        <option>{{$speciality->specialization}}</option>
                        @endif

                        @endforeach
                    </select>

                    @error('speciality')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                </br>

                <div class="col-lg-6 col-12 ">

                    <strong> Appointment Type: </strong>
                    <select name="type" class="form-control form-control-lg @error('type') is-invalid @enderror" {{ $isReadonly ? 'disabled' : '' }}>
                        @if($type == 'Physical' || $type == '')
                        <option selected>Physical</option>
                        <option>Virtual</option>
                        @elseif($type == 'Virtual')
                        <option>Physical</option>
                        <option selected>Virtual</option>
                        @endif
                    </select>

                    @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                </br>
                <a class="btn btn-secondary" href="{{route('welcome')}}">Go Back</a>
                <button type="submit" name="form1" class="btn btn-success" {{ $isReadonly ? 'disabled' : '' }}>Submit</button>
            </form>

            @if($isVisible)
            <div id="id_1" class="mt-3">
                <div class="row">
                    <p class="alert alert-info">Doctor Only Available in Following Days: <span style="color:red;font-weight:bold;">{{$days}}</span></p>
                </div>
                <form method="POST" action="/newappointment/validate/{{Auth::user()->id}}">
                    @csrf
                    <div class="col-lg-6 col-12 ">
                        @if (session('alert_2'))
                        <div class="alert alert-info">
                            {{ session('alert_2') }}
                        </div>
                        @endif
                        @if (session('alert_3'))
                        <div class="alert alert-danger">
                            {{ session('alert_3') }}
                        </div>
                        @endif
                        <label style="font-weight:bold; font-size:large;">Appointment Date:</label>
                        <input type="date" name="date" class="form-control form-control-lg @error('date') is-invalid @enderror" style="width:50%" required />
                        <button type="submit" name="form2" class="btn btn-dark pt-1 pb-1 mb-2 mt-2" style="display:inline-flex;">Check Available Sessions</button>
                </form>

                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <form method="POST" action="/newappointment/{{Auth::user()->id}}">
                    @csrf
                    <strong style="font-weight:bold; font-size:large;">Session:</strong>
                    <input type="text" name="session" class="form-control form-control-lg @error('session') is-invalid @enderror mb-1" style="width:50%;" required />
                    @error('session')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button type="submit" name="form3" class="custom-btn pt-2 pb-2 mt-2">Make Appointment</button>

                </form>
            </div>
            </br>

        </div>
        @endif

    </div>

    <script>
        const doctors = [
            "Test Doctor",
            "New Doctor",
        ];

        const doctorInput = document.getElementById("doctorInput");
        const doctorSelect = document.getElementById("doctorSelect");

        // Function to update the select options based on the input value
        function updateOptions() {
            const inputValue = doctorInput.value.toLowerCase();

            // Clear previous options
            doctorSelect.innerHTML = "";

            // Filter and add new options based on input value
            const filteredDoctors = doctors.filter((doctor) =>
                doctor.toLowerCase().includes(inputValue)
            );

            filteredDoctors.forEach((doctor) => {
                const option = document.createElement("option");
                option.text = doctor;
                doctorSelect.add(option);
            });

            // Show or hide the select based on whether there are matching options
            doctorSelect.style.display = filteredDoctors.length > 0 ? "block" : "none";
        }

        // Event listener to update options whenever the input value changes
        doctorInput.addEventListener("input", updateOptions);

        // Event listener to set the selected doctor when an option is chosen
        doctorSelect.addEventListener("change", function() {
            doctorInput.value = doctorSelect.value;
            doctorSelect.style.display = "none"; // Hide the select after selecting an option
        });
    </script>
</section>

@endsection