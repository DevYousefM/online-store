<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    @include('admin.css')
    <style>
        .accordion-body {
            display: flex;
            flex-wrap: wrap;
            justify-content: center
        }

        .accordion-item span {
            padding: 10px;
            margin: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .5)
        }
    </style>
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
                    @foreach ($orders as $item)
                        <div class="accordion-item bg-dark mt-2">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class=" bg-dark text-white accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#{{ 'flush-collapseThree' . $item->id }}"
                                    aria-expanded="false" aria-controls="flush-collapseThree">
                                    New Order For: {{ $item->user_name }}
                                </button>
                            </h2>
                            <div id="{{ 'flush-collapseThree' . $item->id }}" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-gray-500 text-black">
                                    <span>User Name: {{ $item->user_name }}</span>
                                    <span>Email: {{ $item->email }}</span>
                                    <span>Phone: {{ $item->phone }}</span>
                                    <span>Address: {{ $item->address }}</span>
                                    <span>Product: {{ $item->product_title }}</span>
                                    <span>quantity: {{ $item->quantity }}</span>
                                    <span>Cost: ${{ $item->quantity * $item->price }}</span>
                                    <span>Payment Status: {{ $item->payment_status }}</span>
                                    <span>Ordered At: {{ $item->created_at }}</span>
                                    @if ($item->delivery_status == 'Completed')
                                        <span>Order status: {{ $item->delivery_status }}</span>
                                    @else
                                        <form class="col-md-12 text-center mt-2" action="{{ route('update_order') }}"
                                            method="GET">
                                            @csrf
                                            <div class="form-group color">
                                                <select style="color: white !important" name="order_status"
                                                    style="color: rgba(255, 255, 255, 0.472)" class="form-control"
                                                    id="exampleSelectGender">
                                                    <option style="color: white" selected>{{ $item->delivery_status }}
                                                    </option>
                                                    @if ($item->delivery_status == 'Pending')
                                                        <option style="color: white">Proccess</option>
                                                    @endif
                                                    @if ($item->delivery_status == 'Proccess')
                                                        <option style="color: white">Completed</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <input type="hidden" name="order_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-outline-dark me-2">Update
                                                order</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
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
