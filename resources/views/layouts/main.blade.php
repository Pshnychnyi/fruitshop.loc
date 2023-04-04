<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ (isset($desc)) ? $desc : ''}}">
    <meta name="keywords" content="{{(isset($keywords)) ? $keywords : ''}}">

    <!-- title -->
    <title>FruitShop :: {{(isset($title)) ? $title : ''}}</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('main/img/favicon.png') }}">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('main/css/all.min.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('main/bootstrap/css/bootstrap.min.css') }}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('main/css/owl.carousel.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('main/css/magnific-popup.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('main/css/animate.css') }}">
    <!-- mean menu css -->
    <link rel="stylesheet" href="{{ asset('main/css/meanmenu.min.css') }}">
    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('main/css/main.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('main/css/responsive.css') }}">

</head>
<body>

<!--PreLoader-->
<div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div>
<!--PreLoader Ends-->


<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="{{route('main.index')}}">
                            <img src="{{asset('main/img/logo.png')}}" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        @yield('navigation')
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->

<!--Errors-->
<div class="error-message">
    @include('errors.error')
</div>
<!--/End errors-->

<!-- search area -->
<div class="search-area">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn"><i class="fas fa-window-close"></i></span>
                <div class="search-bar">
                    <div class="search-bar-tablecell">
                        <h3>Найти:</h3>
                        <form action="{{ route('main.search') }}">
                            <input type="text" name="s" placeholder="Введите запрос">
                            <button type="submit">Поиск <i class="fas fa-search"></i></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search area -->

@yield('slider')
<!-- breadcrumb-section -->
@yield('breadcrumbs')
<!-- end breadcrumb section -->
@yield('content')

@yield('footer')

<!-- jquery -->
<script src="{{ asset('main/js/jquery-1.11.3.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('main/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- count down -->
<script src="{{ asset('main/js/jquery.countdown.js') }}"></script>
<!-- isotope -->
<script src="{{ asset('main/js/jquery.isotope-3.0.6.min.js') }}"></script>
<!-- waypoints -->
<script src="{{ asset('main/js/waypoints.js') }}"></script>
<script src="{{ asset('main/js/comment-reply.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('main/js/owl.carousel.min.js') }}"></script>
<!-- magnific popup -->
<script src="{{ asset('main/js/jquery.magnific-popup.min.js') }}"></script>
<!-- mean menu -->
<script src="{{ asset('main/js/jquery.meanmenu.min.js') }}"></script>
<!-- sticker js -->
<script src="{{ asset('main/js/sticker.js') }}"></script>
<!--validate-->
<script src="{{ asset('main/js/form-validate.js') }}"></script>
<!-- main js -->
<script src="{{ asset('main/js/main.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>


</body>
</html>
