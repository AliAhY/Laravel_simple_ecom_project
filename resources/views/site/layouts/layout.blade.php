<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/all.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category_with_blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/heade.css') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    @yield('cssAndJs')

</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light  navbar-fixed"
        style="background-color: rgba(195, 190, 189, 0.511)">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/YEP-logo/vector/default.svg') }}" style="width: 80px" alt="شعار" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="تبديل التنقل">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">

                @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" id="category-{{ $category->id }}"
                            >{{ $category->name }}</a>
                    </li>
                @endforeach


            </ul>
        </div>

        <form class="d-flex">
            <div class="search-container" style="position: relative;">
                <input type="search" class="form-control me-4" id="search" style="width: 300px;"
                    placeholder="بحث...">
                <div id="searchResults" style="width: 300px"></div>
            </div>

        </form>
        @if (Auth::check())
            @if (Auth::user()->email == 'admin@admin.com')
                <script>
                    window.location.href = "{{ url('/dashboard') }}"; // استبدل /admin/login بمسار صفحة تسجيل الدخول للمدير  
                </script>
            @endif
            <span class="nav-link">مرحبًا، {{ Auth::user()->name }}</span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                </li>
            </ul>
        @else
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ url('/register') }}">Sign up</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ url('/user/login') }}">Login</a>
                </li>
            </ul>
        @endif



    </nav>



    <div class="p-2">
        @yield('main')
    </div>


    <div class="footer-content " style="background-color: rgba(195, 190, 189, 0.995)">
        <div class="row">
            <div class="col-12 col-md-6 footer-left">
                <p>&copy; 2023 YTP. جميع الحقوق محفوظة.</p>
            </div>
            <div class="col-12 col-md-6 footer-right text-right">
                <a href="https://www.facebook.com/yourprofile" target="_blank">
                    <i class="fab fa-facebook-square mx-2" aria-hidden="true"></i>
                </a>
                <a href="https://twitter.com/yourprofile" target="_blank">
                    <i class="fab fa-twitter-square mx-2" aria-hidden="true"></i>
                </a>
                <a href="https://www.instagram.com/yourprofile" target="_blank" style="text-decoration: none">
                    <i class="fab fa-instagram-square mx-2" aria-hidden="true"
                        style="background-color: rgb(243, 173, 61)"></i>
                </a>
            </div>
        </div>
    </div>




    
    <script>
        $(document).ready(function() {
            // تحديد الرابط النشط بناءً على عنوان URL الحالي  
            const currentUrl = window.location.href;
            $('.nav-link').each(function() {
                const linkUrl = $(this).attr('href');
                if (currentUrl.includes(linkUrl)) {
                    $(this).addClass('active'); // إضافة فئة active للرابط النشط  
                }
            });



           
        });
    </script>



</body>

</html>


</body>

</html>
