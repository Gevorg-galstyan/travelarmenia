<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{config('app.name')}} | 404</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT CSS-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/font/font-icon/font-awesome/css/font-awesome.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/font/font-icon/font-flaticon/flaticon.css')}}">
    <!-- LIBRARY CSS-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/animate/animate.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/slick-slider/slick.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/slick-slider/slick-theme.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/selectbox/css/jquery.selectbox.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/please-wait/please-wait.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/fancybox/css/jquery.fancybox.css?v=2.1.5')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/fancybox/css/jquery.fancybox-buttons.css?v=1.0.5')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/fancybox/css/jquery.fancybox-thumbs.css?v=1.0.7')}}">
    <!-- STYLE CSS-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/layout.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/color.css')}}">
    <!--link(type="text/css", rel='stylesheet', href='assets/css/color-1/color-1.css', id="color-skins")-->
    <link type="text/css" rel="stylesheet" href="#" id="color-skins">
    <script src="{{asset('assets/libs/jquery/jquery-2.2.3.min.js')}}"></script>
    <script src="{{asset('assets/libs/js-cookie/js.cookie.js')}}"></script>
</head>

<body>
<div class="body-wrapper">
    <!-- WRAPPER CONTENT-->
    <div class="wrapper-content">
        <!-- HEADER-->
        <header>
            <!-- NULL-->
        </header>
        <!-- WRAPPER-->
        <div id="wrapper-content">
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <section class="page-404" style="background-image: url({{asset('storage/'.setting('site.404_image'))}});">
                    <div class="page-clouds-1"></div>
                    <div class="page-clouds-2"></div>
                    <div class="page-wrapper">
                        <div class="page-content">
                            <h1 class="title-1">404</h1>
                            <h2 class="title-2">page not found</h2>
                            <div class="group-button">
                                <a href="{{ URL::previous() }}" class="btn btn-maincolor">back</a>
                                <a href="{{ route('home') }}" class="btn btn-maincolor">back to home</a>
                            </div>

                        </div>
                    </div>
                    <div class="page-clouds-3"></div>
                </section>
            </div>
        </div>
        <!-- FOOTER-->
        <footer>
            <!-- NULL-->
        </footer>
    </div>
</div>

<!-- LIBRARY JS-->
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/libs/detect-browser/browser.js')}}"></script>
<script src="{{asset('assets/libs/smooth-scroll/jquery-smoothscroll.js')}}"></script>
<script src="{{asset('assets/libs/wow-js/wow.min.js')}}"></script>
<script src="{{asset('assets/libs/slick-slider/slick.min.js')}}"></script>
<script src="{{asset('assets/libs/selectbox/js/jquery.selectbox-0.2.js')}}"></script>
<script src="{{asset('assets/libs/please-wait/please-wait.min.js')}}"></script>
<script src="{{asset('assets/libs/fancybox/js/jquery.fancybox.js')}}"></script>
<script src="{{asset('assets/libs/fancybox/js/jquery.fancybox-buttons.js')}}"></script>
<script src="{{asset('assets/libs/fancybox/js/jquery.fancybox-thumbs.js')}}"></script>
<!--script(src="assets/libs/parallax/jquery.data-parallax.min.js")-->
<!-- MAIN JS-->
<script src="{{asset('assets/js/main.js')}}"></script>
<!-- LOADING JS FOR PAGE-->
</body>

</html>