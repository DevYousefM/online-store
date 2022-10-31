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
            <div class="heading_container heading_center">
                <h2>
                    Our <span>products</span>
                </h2>
            </div>
            <div class="btn-box">
                <a href="{{ route('_catagory', 'all') }}">View All products</a>
            </div>
            <div class="row">

                @isset($products)
                    @foreach ($products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="box">
                                <div class="option_container">
                                    <div class="options">
                                        <form method="POST" action="{{ route('add_to_cart') }}">
                                            @method('GET')
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input class="option1" type="submit" value="Add To Cart">
                                        </form>
                                        <a href="{{ route('single_product', $product->id) }}" class="option2">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                                <div class="img-box">
                                    <img src="{{ asset('app/' . $product->image) }}" alt="">
                                </div>
                                <div class="detail-box" style="flex-direction:column !important">
                                    <h5>
                                        {{ $product->title }}
                                    </h5>
                                    <h6 style="text-decoration: line-through 3px;">
                                        ${{ $product->price }}
                                    </h6>
                                    <h4>${{ $product->discount }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </section>
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    @include('home.script')
</body>

</html>
