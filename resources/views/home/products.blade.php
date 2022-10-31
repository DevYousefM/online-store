<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">

            @isset($phones)
                @foreach ($phones as $phone)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                            <div class="option_container">
                                <div class="options">
                                    <form method="POST" action="{{ route('add_to_cart') }}">
                                        @method('GET')
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $phone->id }}">
                                        <input class="option1" type="submit" value="Add To Cart">
                                    </form>
                                    <a href="{{ route('single_product', $phone->id) }}" class="option2">
                                        View Details
                                    </a>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="{{ 'app/' . $phone->image }}" alt="">
                            </div>
                            <div class="detail-box" style="flex-direction:column !important">
                                <h5>
                                    {{ $phone->title }}
                                </h5>
                                <h6 style="text-decoration: line-through 3px;">
                                    ${{ $phone->price }}
                                </h6>
                                <h4>${{ $phone->discount }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
            @isset($cams)
                @foreach ($cams as $cam)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                            <div class="option_container">
                                <div class="options">
                                    <form method="POST" action="{{ route('add_to_cart') }}">
                                        @method('GET')
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $cam->id }}">
                                        <input class="option1" type="submit" value="Add To Cart">
                                    </form>
                                    <a href="{{ route('single_product', $cam->id) }}" class="option2">
                                        View Details
                                    </a>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="{{ 'app/' . $cam->image }}" alt="">
                            </div>
                            <div class="detail-box" style="flex-direction:column !important">
                                <h5>
                                    {{ $cam->title }}
                                </h5>
                                <h6 style="text-decoration: line-through 3px;">
                                    ${{ $cam->price }}
                                </h6>
                                <h4>${{ $cam->discount }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
            @isset($laptops)
                @foreach ($laptops as $laptop)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                            <div class="option_container">
                                <div class="options">
                                    <form method="POST" action="{{ route('add_to_cart') }}">
                                        @method('GET')
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $laptop->id }}">
                                        <input class="option1" type="submit" value="Add To Cart">
                                    </form>
                                    <a href="{{ route('single_product', $laptop->id) }}" class="option2">
                                        View Details
                                    </a>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="{{ 'app/' . $laptop->image }}" alt="">
                            </div>
                            <div class="detail-box" style="flex-direction:column !important">
                                <h5>
                                    {{ $laptop->title }}
                                </h5>
                                <h6 style="text-decoration: line-through 3px;">
                                    ${{ $laptop->price }}
                                </h6>
                                <h4>${{ $laptop->discount }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
        <div class="btn-box">
            <a href="{{ route('products_page') }}">
                View All products
            </a>
        </div>
    </div>
</section>
