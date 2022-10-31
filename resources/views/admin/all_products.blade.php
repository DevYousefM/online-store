<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success flex justify-between fade show" role="alert">
                            <strong> {{ session()->get('message') }} </strong>
                            <button type="button" class="btn-close text-black flex justify-center items-center"
                                data-bs-dismiss="alert" aria-label="Close">
                                <strong>X</strong>
                            </button>
                        </div>
                    @endif
                    <ul class="flex flex-row mb-2" style="justify-content: space-around">
                        @foreach ($catagories as $cata)
                            <li>
                                <a href="#{{ $cata->catagory_name }}"
                                    class="btn btn-outline-success text-white">{{ $cata->catagory_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    @foreach ($catagories as $cata)
                        <div id={{ $cata->catagory_name }}>
                            <h1 class=" text-2xl text-center shadow">{{ $cata->catagory_name }}</h1>
                            <div class="cards flex flex-wrap justify-center">
                                @isset($catagories)
                                    <table class="table border">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Discount</th>
                                                <th scope="col">Quantity</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($products as $item)
                                                @if ($item->catagory == $cata->catagory_name)
                                                    <tr>
                                                        <th scope="row">
                                                            <a href="{{ route('del_product', $item->id) }}"
                                                                onclick="return confirm('Are you sure to delete this product?');"
                                                                class="px-2 bg-red-600 text-white"
                                                                style="border-radius: 4px">X</a>
                                                        </th>
                                                        <th scope="row" class="underline"><a
                                                                href="{{ route('product_page', $item->id) }}">{{ $item->title }}</a>
                                                        </th>
                                                        <th scope="row">{{ $item->price }}</th>
                                                        <th scope="row">{{ $item->discount }}</th>
                                                        <th scope="row">{{ $item->quantity }}</th>
                                                        <th scope="row">
                                                            <img src={{ asset('app/' . $item->image) }}
                                                                class="card-img-top">
                                                        </th>

                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endisset
                            </div>
                        </div>
                        <div class="w-full border"></div>
                    @endforeach
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')

</body>

</html>
