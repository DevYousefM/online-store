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


    <section class="product_section layout_padding pt-5" style="padding:30px 0 !important">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success flex justify-between fade show" role="alert">
                    <strong> {{ session()->get('message') }} </strong>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    <a class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            @isset($in_cart)
                @if (count($in_cart) > 0)
                    <?php $total_price = 0; ?>
                    @foreach ($in_cart as $item)
                        <div class="row text-center border pt-1">
                            <div class="col-md-4 flex justify-center mb-3">
                                <img src={{ asset('app/' . $item->image) }} style="width:100%">
                            </div>
                            <div class="col-md-8 flex flex-col items-center">
                                <h1 class="text-center text-xl mb-2">{{ $item->product_title }}</h1>
                                <h5>Product price: ${{ $item->price }}</h5>
                                <h5>Total: ${{ $item->price * $item->quantity }}</h5>
                                <h5>Quantity: {{ $item->quantity }}</h5>
                                <form action="{{ route('update_qtn') }}" class="pt-2 col-md-6"
                                    style="flex-direction: column;" method="POST">
                                    @method('GET')
                                    @csrf
                                    <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                    <input type="number" min="1"
                                        style="background-color: white !important;color:black !important" name="quantity"
                                        value="{{ $item->quantity }}">
                                    <input name="submit" type="submit" value="Update Quantity">
                                </form>
                                <a href="{{ route('del_from_cart', $item->id) }}"
                                    onclick="return confirm('Are you sure to delete this product?')"
                                    style="width:100px;background-color:red" class="px-4 py-1 mb-2 text-white">Delete</a>
                            </div>
                        </div>
                        <?php $total_price += $item->price * $item->quantity; ?>
                    @endforeach
                    <h1 class="text-2xl text-center mt-2 text-red-500">Total Price: ${{ $total_price }}</h1>
                    <div class="btn-box" style="margin-top:20px !important">
                        <a href="{{ route('checkout_delivery') }}" class="btn1">
                            Pay on delivery
                        </a>
                        <a href="{{ route('checkout_card', $total_price) }}" class="btn1">
                            Pay by credit card
                        </a>
                    </div>
                @else
                    <div class="alert text-center">
                        <h1 class="text-2xl text-red-600">Your cart is empty</h1>
                        <div class="btn-box">
                            <a href="{{ route('products_page') }}">
                                Browse Products
                            </a>
                        </div>
                    </div>
                @endif

            @endisset
        </div>
    </section>
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    @include('home.script')
</body>

</html>
