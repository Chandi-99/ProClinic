@extends('layouts.stafflayout')
@section('content')
<section class="section-padding section-bg mt-0 pt-5">
    <div class="container ">
        @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <p>{{ Session::get('success') }}</p>
        </div>
        @endif
        <div class="custom-text-box  align-items-center mt-0 pt-2" style="padding-left: 50px;">
            <h6 class="text-center pt-2" style="font-size:larger;">Create Doctor Appointment</h6>
            <form method="POST" action="/staff/newappointment">
                @csrf

                <div class="col-lg-6 col-12">
                    <strong> Patient: </strong>
                    <select type="text" id="patient" name="patient" class="form-control form-control-lg @error('patient') is-invalid @enderror" required {{ $isReadonly ? 'disabled' : '' }}>
                    @foreach($patients as $patient)
                        <option value="{{$patient->patient_id}}">{{$patient->fname}} {{$patient->lname}}</option>
                    @endforeach
                    </select>
                    @error('patient')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div></br>


                <div class="col-lg-6 col-12">
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
                <a class="btn btn-secondary" href="/staff">Go Back</a>
                <button type="submit" name="form1" class="btn btn-success" {{ $isReadonly ? 'disabled' : '' }}>Submit</button>
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