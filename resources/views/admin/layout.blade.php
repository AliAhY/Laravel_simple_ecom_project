<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tom-select.css') }}">
    {{-- for message --}}
    <link rel="stylesheet" href="{{ asset('css/tom-select.css') }}">
    {{-- ----------- --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
    @yield('cssAndJs')
</head>

<body class="">

    <div class="row">
        <div class="col-2 side_bar" style="height: 100vh;">

            <div class="my-2">
                <img class="img-fluid w-50" src="{{ asset('images/logo.png') }}">

                <h4 class="text-white mt-2">{{ \Illuminate\Support\Facades\Auth::user()->name }}</h4>
            </div>


            <hr style="color: #fff" />

            <div class="mx-4 text-start">

                {{-- <a href="{{ route('dashboard.index') }}"> --}}
                <a href="">
                    <div class="menu_item @if (request()->routeIs('dashboard.index')) menu_item_active @endif">
                        <i class="fa-solid fa-house mx-2"></i>
                        Home
                    </div>
                </a>


                <a href="{{ route('dashboard.products.index') }}">
                    <div class="menu_item @if (request()->routeIs('dashboard.products.*')) menu_item_active @endif">
                        <i class="fa-solid fa-book mx-2"></i>
                        Products
                    </div>
                </a>



                <a href="{{ route('dashboard.categories.index') }}">
                    <div class="menu_item  @if (request()->routeIs('dashboard.categories.*')) menu_item_active @endif">
                        <i class="fa-solid fa-book mx-2"></i>
                        Categories
                    </div>
                </a>

                <a href="{{ route('dashboard.all_orders') }}">
                    <div class="menu_item  @if (request()->routeIs('dashboard.all_orders')) menu_item_active @endif">
                        <i class="fa-solid fa-book mx-2"></i>
                        Orders
                    </div>
                </a>



            </div>


            <a href="{{ route('logout') }}">
                <div class="mx-4 menu_item logout_link ">
                    <i class="fa-solid fa-house mx-2"></i>
                    Logout
                </div>
            </a>


        </div>



        <div class="col-10 p-0 m-0">

            <div class="p-2">
                @yield('main')
            </div>

        </div>


    </div>

    <script>
        function hideNotification(notification) {
            notification.style.display = 'none';
        }
    </script>
</body>

</html>
