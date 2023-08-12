@extends('layouts.app')
@section('content')
<section class="section-padding section-bg mt-0 pt-2">
    <div class="container ">
        <div class="row" >
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 " style="background-color:white;">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="/oldappointments/{{Auth::user()->id}}" class="d-block " style="text-decoration:none;">
                        <img src="/images/test1.png " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">

                        <p class="featured-block-text " style="text-decoration:none;">View <strong>Old Appointments</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 " style="background-color:white;">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="/incomingappointments/{{Auth::user()->id}}" class="d-block " style="text-decoration:none;">
                        <img src="/images/test2.png " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">

                        <p class="featured-block-text " style="text-decoration:none;">View <strong>Incoming Appointments</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 " style="background-color:white;">
                <div class="featured-block d-flex justify-content-center align-items-center ">
                    <a href="/addmore/{{Auth::user()->id}}" class="d-block " style="text-decoration:none;">
                        <img src="/images/addmore.jpg " class="featured-block-image img-fluid mt-2" alt=" " height="130px" width="130px">

                        <p class="featured-block-text " style="text-decoration:none;">Add More<strong> About You</strong></p>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 " style="background-color:white;">
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
            <h4 class="text-center pt-2" style="font-size:larger;">Create Doctor Appointment</h4>
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
                        <option>{{$speciality->specialization}}</option>
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
                        <option>TeleMedicine</option>
                        @elseif($type == 'TeleMedicine')
                        <option>Physical</option>
                        <option selected>VirtuTeleMedicineal</option>
                        @endif
                    </select>

                    @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                </br>
                <a class="btn custom-btn pt-1 pb-1" href="{{route('welcome')}}">Back</a>
                <button type="submit" class="btn custom-btn pt-1 pb-1" >Submit</button>
            </form>
    </div>

    <script>
        const doctors = [
            "Amal Perera",
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