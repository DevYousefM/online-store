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


    <section class="product_section layout_padding pt-5">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success flex justify-between fade show" role="alert">
                    <strong> {{ session()->get('message') }} </strong>
                </div>
            @endif
            @isset($product)

                @foreach ($product as $item)
                    <div class="row text-center">
                        <div class="col-md-4 flex justify-center mb-3">
                            <img src={{ asset('app/' . $item->image) }} style="width:100%">
                        </div>
                        <div class="col-md-8">
                            <h1 class="text-center">{{ $item->title }}</h1>
                            <p>
                                {{ $item->description }}
                            </p>
                            <h5 style="text-decoration: line-through 3px;">${{ $item->price }}</h5>
                            <h1>${{ $item->discount }}</h1>
                            <h5>Available Quantity:{{ $item->quantity }}</h5>
                            <form class="btn-box" method="POST" action="{{ route('add_to_cart') }}">
                                @method('GET')
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <input name="submit" type="submit" value="Add To Cart">
                            </form>
                        </div>
                    </div>
                @endforeach
            @endisset

        </div>
    </section>
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    @include('home.script')
</body>

</html>
