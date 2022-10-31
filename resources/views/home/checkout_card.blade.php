<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    @include('home.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/payment.js') }}"></script>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <h1 class="text-center text-2xl mt-2" style="color: red">Payment</h1>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                            data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                            @csrf
                            <input required type="text" name="user_name" placeholder="Full Name"
                                style="background-color: white !important;color:black !important;text-transform:none"
                                name="user_name">
                            <input required type="email" name="email" placeholder="Email Address"
                                style="background-color: white !important;color:black !important;text-transform:none"
                                name="user_name">
                            <input required type="text" name="address" placeholder="Receipt address in detail"
                                style="background-color: white !important;color:black !important;text-transform:none"
                                name="user_name">
                            <input required type="number" name="phone" min="1"
                                style="background-color: white !important;color:black !important;text-transform:none"
                                name="phone" placeholder="Phone Number">

                            <input required autocomplete='off' class='card-number' size='20'
                                placeholder="Card Number"
                                style="background-color: white !important;color:black !important;text-transform:none"
                                type='number'>

                            <div class='form-row row'>
                                <div class='col-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label> <input required autocomplete='off'
                                        class=' card-cvc' placeholder='ex. 311' size='4' type='number'>
                                </div>
                                <div class='col-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label> <input required
                                        class=' card-expiry-month' placeholder='MM' size='2' type='number'>
                                </div>
                                <div class='col-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label> <input required
                                        class=' card-expiry-year' placeholder='YYYY' size='4' type='number'>
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-md-12 error form-group hide'>
                                    <div class='alert-danger alert'>Please correct the errors and try
                                        again.</div>
                                </div>
                            </div>

                            <input type="hidden" name="total_price" value="{{ $total }}">

                            <div class="row">
                                <div class="col-12">
                                    <input name="btnSubmit" type="submit" class="my-2"
                                        value="Pay Now (${{ $total }})">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

</html>
