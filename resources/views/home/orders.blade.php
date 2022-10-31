<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <style>
        a {
            color: black !important;
            text-decoration: none !important;
        }

        .accordion-item {
            color: black;
            background: white
        }

        .accordion-button:focus {
            border-color: transparent !important;
        }

        .accordion-body {
            display: flex;
            flex-wrap: wrap;
            justify-content: center
        }

        .accordion-item span {
            padding: 10px;
            margin: 10px;
        }

        .accordion-item span mark {
            background-color: transparent;
            color: black;
            font-weight: 700;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <!-- Styles -->
    @livewireStyles
    <style>
        button.inline-flex {
            background: white !important
        }
    </style>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />
    <div>
        @include('profile.header')
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper">
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        @if (count($orders) > 0)

                            <?php $count = 0; ?>
                            @foreach ($orders as $item)
                                <?php $count++; ?>
                                <div class="accordion mt-2 <?= $item->delivery_status === 'Completed' ? 'bg-success' : 'bg-warning' ?> accordion-flush pb-2"
                                    id="{{ 'accordionFlushExample' . $count }}">
                                    <div class="accordion-item border shadow">
                                        <h2 class="accordion-header" id="{{ 'flush-headingOne' . $count }}">
                                            <button class="accordion-button collapsed text-black bg-white"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#{{ 'flush-collapseOne' . $count }}"
                                                aria-expanded="false"
                                                aria-controls="{{ 'flush-collapseOne' . $count }}">
                                                {{ $item->delivery_status }}
                                            </button>
                                        </h2>
                                        <div id="{{ 'flush-collapseOne' . $count }}" class="accordion-collapse collapse"
                                            aria-labelledby="{{ 'flush-headingOne' . $count }}"
                                            data-bs-parent="#{{ 'accordionFlushExample' . $count }}">
                                            <div class="accordion-body">
                                                <span class="shadow-md"> <mark> User Name: </mark>
                                                    {{ $item->user_name }}</span>
                                                <span class="shadow-md"> <mark> Email: </mark>
                                                    {{ $item->email }}</span>
                                                <span class="shadow-md"> <mark> Phone: </mark>
                                                    {{ $item->phone }}</span>
                                                <span class="shadow-md"> <mark> Address: </mark>
                                                    {{ $item->address }}</span>
                                                <span class="shadow-md"> <mark> Product: </mark>
                                                    {{ $item->product_title }}</span>
                                                <span class="shadow-md"> <mark> quantity: </mark>
                                                    {{ $item->quantity }}</span>
                                                <span class="shadow-md"> <mark> Cost:</mark>
                                                    ${{ $item->quantity * $item->price }}</span>
                                                <span class="shadow-md"> <mark> Payment Status: </mark>
                                                    {{ $item->payment_status }}</span>
                                                <span class="shadow-md"> <mark> Ordered At: </mark>
                                                    {{ $item->created_at }}</span>
                                                <span class="shadow-md"> <mark> Order Status:
                                                    </mark>{{ $item->delivery_status }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h4 class="text-center mt-2 text-red-500">There is no orders</h4>
                        @endif
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

    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
