<!-- header section strats -->
<header class="header_section shadow">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="{{ url('/') }}"><img width="250" src={{ asset('images/logo.png') }}
                    alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav items-center relative">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products_page') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                        <a href="{{ route('cart') }}" class="" style="color: black">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                    </button>
                    <button type="button" id="search_icon" class="btn my-2 my-sm-0 nav_search-btn">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                    <ul class="lo-re shadow border" id="lo-re">
                        <li class="header-btn">
                            <a class="btn1" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="header-btn">
                            <a class="btn1" href="{{ route('register') }}">Register</a>
                        </li>
                    </ul>

                    <form class="form-inline" action="{{ route('search') }}" method="POST">
                        @csrf

                        <div class="div_search" id="div_search">
                            <input type="search" name="search" class="search_field">
                            <button class="btn_submit" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                    @if (Route::has('login'))
                        @auth
                            <x-app-layout>

                            </x-app-layout>
                        @else
                            <button class="btn my-2 my-sm-0 nav_search-btn" id="user_icon" type="submit">
                                <i class="fa fa-user text-black" aria-hidden="true"></i>
                            </button>
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- end header section -->
