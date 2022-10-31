<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href={{ asset('images/favicon.png') }} type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    @include('home.css')
</head>

<body>
    <!-- header section strats -->
    @include('home.header')
    <!-- header section ends -->
    <div class="flex flex-col items-center">
        <h1 class="text-center text-red-600 text-2xl mt-2">Checkout</h1>
        <form action="{{ route('create_order') }}" class="pt-2 col-md-6 flex" style="flex-direction: column"
            method="POST">
            @method('GET')
            @csrf
            <input type="text" name="user_name" placeholder="Full Name"
                style="background-color: white !important;color:black !important;text-transform:none" name="user_name">
            <input type="email" name="email" placeholder="Email Address"
                style="background-color: white !important;color:black !important;text-transform:none" name="user_name">
            <input type="text" name="address" placeholder="Receipt address in detail"
                style="background-color: white !important;color:black !important;text-transform:none" name="user_name">
            <input type="number" name="phone" min="1"
                style="background-color: white !important;color:black !important;text-transform:none" name="phone"
                placeholder="Phone Number">
            <input type="hidden" name="payment_method" value="On Delivery">

            <input name="submit" type="submit" class="my-2" value="Complete Order">
        </form>
    </div>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    @include('home.script')
</body>

</html>
