@extends('layouts.doctorlayout')
@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center;"><b>{{ __('Edit your Profile') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="/editDoctor/{{Auth::user()->id}}">
                        @csrf
                        <div class="text-center">
                            @if(session('alert_2'))
                            <div class="alert alert-success">
                                {{ session('alert_2') }}
                            </div>
                            @endif
                        </div>
                        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$username[0]->name}}" name="name" required autocomplete="name" autofocus readonly>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror"  name="fname" value="{{$doctor[0]->fname}}" required autocomplete="fname" autofocus>
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid First Name</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{$doctor[0]->lname}}" required autocomplete="lname" autofocus>
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Last Name</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" required autocomplete="gender" disabled>
                                    @if($doctor[0]->gender == 'Male')
                                    <option selected>Male</option>
                                    <option>Female</option>
                                    @else
                                    <option>Male</option>
                                    <option selected>Female</option>
                                    @endif
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Gender was Unidentified</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dob" class="col-md-4 col-form-label text-md-end">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" value="{{$doctor[0]->dob}}" name="dob" required disabled>
                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Date of Birth Inserted</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nic" class="col-md-4 col-form-label text-md-end">{{ __('Registered Number') }}</label>

                            <div class="col-md-6">
                                <input id="regNum" type="text" class="form-control @error('regNum') is-invalid @enderror" name="regNum" value="{{$doctor[0]->regNum}}" required  disabled>
                                @error('regNum')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Registered Number</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="specialization" class="col-md-4 col-form-label text-md-end">{{ __('Specialization') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" required autocomplete="specialization">
                                    @if($doctor[0]->specialization == "General")
                                    <option value="General" selected>General</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Neurology">Neurology</option>
                                    @elseif($doctor[0]->specialization == "Pediatrics")
                                    <option value="General">General</option>
                                    <option value="Pediatrics" selected>Pediatrics</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Neurology">Neurology</option>
                                    @elseif($doctor[0]->specialization == "Internal Medicine")
                                    <option value="General">General</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Internal Medicine" selected>Internal Medicine</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Neurology">Neurology</option>
                                    @elseif($doctor[0]->specialization == "Surgery")
                                    <option value="General">General</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="Surgery" selected>Surgery</option>
                                    <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Neurology">Neurology</option>
                                    @elseif($doctor[0]->specialization == "Obstetrics and Gynecology")
                                    <option value="General">General</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Obstetrics and Gynecology" selected>Obstetrics and Gynecology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Neurology">Neurology</option>
                                    @elseif($doctor[0]->specialization == "Psychiatry")
                                    <option value="General">General</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                                    <option value="Psychiatry" selected>Psychiatry</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Neurology">Neurology</option>
                                    @elseif($doctor[0]->specialization == "Cardiology")
                                    <option value="General">General</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Cardiology" selected>Cardiology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Neurology">Neurology</option>
                                    @elseif($doctor[0]->specialization == "Oncology")
                                    <option value="General">General</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Oncology" selected>Oncology</option>
                                    <option value="Neurology">Neurology</option>
                                    @elseif($doctor[0]->specialization == "Neurology")
                                    <option value="General">General</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Neurology" selected>Neurology</option>
                                    @endif
                                </select>
                                @error('specialization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid Specialization</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="echanneling" class="col-md-4 col-form-label text-md-end">{{ __('E-channeling') }}</label>

                            <div class="col-md-6">
                                <select id="echanneling" type="text" class="form-control @error('echanneling') is-invalid @enderror" name="echanneling" required autocomplete="echanneling">
                                    @if($doctor[0]->echanneling_rate > 0)
                                    <option selected>Yes</option>
                                    <option>No</option>
                                    @else
                                    <option >Yes</option>
                                    <option selected>No</option>
                                    @endif

                                </select>
                                @error('echanneling')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Echanneling status was Unidentified</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" id="echanneling_rate" hidden>
                            <label for="nic" class="col-md-4 col-form-label text-md-end">{{ __('E-Channeling Rate') }}</label>

                            <div class="col-md-6">

                                <input type="number" id="echanneling_rate" name="echanneling_rate" class="form-control @error('echanneling_rate') is-invalid @enderror" value="{{$doctor[0]->echanneling_rate }}" required autocomplete="echanneling_rate">
                                @if($doctor[0]->echanneling_rate > 0)
                                <script>
                                    document.getElementById('echanneling_rate').hidden = false;
                                </script>
                                @endif
                                <script>
                                    document.querySelector('select[name="echanneling"]').addEventListener('change', function() {
                                        if (this.value === 'Yes') {
                                            document.getElementById('echanneling_rate').hidden = false;
                                        } else if (this.value === 'No') {
                                            document.getElementById('echanneling_rate').hidden = true;
                                        }
                                    });
                                </script>
                                @error('echanneling_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid echanneling_rate</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3" id="normal_rate">
                            <label for="nic" class="col-md-4 col-form-label text-md-end">{{ __('Normal Channeling Rate') }}</label>

                            <div class="col-md-6">

                                <input type="number" id="normal_rate" value="{{$doctor[0]->normal_rate}}" name="normal_rate" class="form-control @error('normal_rate') is-invalid @enderror" value="{{ old('normal_rate') }}" required autocomplete="normal_rate">

                                @error('normal_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid normal_rate</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="number" value="0{{$doctor[0]->contact}}" class="form-control @error('contact') is-invalid @enderror" name="contact" required autocomplete="contact" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn custom-btn pt-1 pb-1" href="/doctor" style="margin-right:5px">Back</a>
                                <button type="submit" class="btn custom-btn pt-1 pb-1" >
                                    {{ __('Update') }}
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection