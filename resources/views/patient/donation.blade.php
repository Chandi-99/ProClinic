@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="col-lg-6 col-12 mx-auto custom-text-box " style="background-color:aquamarine">
            @if (session('alert_01'))
            <div class="alert alert-danger">
                {{ session('alert_01') }}
            </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
            <form class="custom-form donate-form" action="{{route('donationpost')}}" method="post" role="form">
                @csrf
                <h4 class="mb-4 text-center">Make a donation</h4>

                <div class="row">
                    <div class="col-lg-12 col-12">
                        <h5 class="mt-2 mb-3">Select an amount</h5>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 form-check-group">
                        <div class="form-check form-check-radio">
                            <input class="form-check-input" type="radio" name="amount" id="10" value='10'>
                            <label class="form-check-label" for="flexRadioDefault1">
                                $10
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 form-check-group">
                        <div class="form-check form-check-radio">
                            <input class="form-check-input" type="radio" name="amount" id="15" value='15'>
                            <label class="form-check-label" for="flexRadioDefault2">
                                $15
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 form-check-group">
                        <div class="form-check form-check-radio">
                            <input class="form-check-input" type="radio" name="amount" id="20" value='20'>
                            <label class="form-check-label" for="flexRadioDefault3">
                                $20
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 form-check-group">
                        <div class="form-check form-check-radio">
                            <input class="form-check-input" type="radio" name="amount" id="30" value='30'>
                            <label class="form-check-label" for="flexRadioDefault4">
                                $30
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 form-check-group">
                        <div class="form-check form-check-radio">
                            <input class="form-check-input" type="radio" name="amount" id="45" value='45'>
                            <label class="form-check-label" for="flexRadioDefault5">
                                $45
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 form-check-group">
                        <div class="form-check form-check-radio">
                            <input class="form-check-input" type="radio" name="amount" id="50" value='50'>
                            <label class="form-check-label" for="flexRadioDefault6">
                                $50
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 form-check-group">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">$</span>
                            <input type="number" name="custom_amount" class="form-control" placeholder="Custom amount" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="col-lg-12 col-12">
                        <h5 class="mt-1">Personal Info</h5>
                    </div>

                    <div class="col-lg-6 col-12 mt-2">
                        <input type="text" name="donation-name" id="donation-name" class="form-control" placeholder="Jack Doe" required>
                    </div>

                    <div class="col-lg-6 col-12 mt-2">
                        <input type="email" name="donation-email" id="donation-email" class="form-control" placeholder="Jackdoe@gmail.com" required>
                    </div>

                    <div class="col-lg-12 col-12">
                        <h5 class="mt-4 pt-1">Choose Payment</h5>
                    </div>

                    <div class="col-lg-12 col-12 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="DonationPayment" id="debitcard" value="debitcard">
                            <label class="form-check-label" for="flexRadioDefault9">
                                <i class="bi-credit-card custom-icon ms-1"></i>
                                Debit or Credit card
                            </label>
                        </div>
                        <button type="submit" class="form-control mt-4">Submit Donation</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection