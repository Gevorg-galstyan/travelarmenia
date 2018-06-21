<!doctype html >
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="token" content="{{csrf_token()}}">
    <link rel="shortcut icon" href="{{asset('storage/'.setting('site.title_icone'))}}">
    @section('meta')
        <title>{{setting('site.title')}}</title>
        <meta name="description" content="{{setting('site.description')}}">
        <meta name="keywords" content="{{setting('site.keywords')}}">
    @show
<!-- FONT CSS-->
    @section('link')
        <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900">
        <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
        <link type="text/css" rel="stylesheet"
              href="{{asset('assets/font/font-icon/font-awesome/css/font-awesome.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/font/font-icon/font-flaticon/flaticon.css')}}">
        <!-- LIBRARY CSS-->
        <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/animate/animate.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/slick-slider/slick.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/slick-slider/slick-theme.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/selectbox/css/jquery.selectbox.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/please-wait/please-wait.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/fancybox/css/jquery.fancybox.css?v=2.1.5')}}">
        <link type="text/css" rel="stylesheet"
              href="{{asset('assets/libs/fancybox/css/jquery.fancybox-buttons.css?v=1.0.5')}}">
        <link type="text/css" rel="stylesheet"
              href="{{asset('assets/libs/fancybox/css/jquery.fancybox-thumbs.css?v=1.0.7')}}">
        <link type="text/css" rel="stylesheet"
              href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
        <!-- STYLE CSS-->
        <link type="text/css" rel="stylesheet" href="{{asset('assets/css/layout.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('assets/css/color.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}">
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css"
              rel="stylesheet">
        <!--link(type="text/css", rel='stylesheet', href='assets/css/color-1/color-1.css', id="color-skins")-->

    @show
    <script src="https://code.jquery.com/jquery-1.10.2.js"
            integrity="sha256-it5nQKHTz+34HijZJQkpNBIHsjpV8b6QzMJs9tmOBSo=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>
    {!! Toastr::render() !!}
    {{--<script src="{{asset('assets/libs/js-cookie/js.cookie.js')}}"></script>--}}
    {{--<script>--}}
    {{--if ((Cookies.get('color-skin') != undefined) && (Cookies.get('color-skin') != 'color-1')) {--}}
    {{--$('#color-skins').attr('href', 'assets/css/' + Cookies.get('color-skin') + '/' + 'color.css');--}}
    {{--}--}}
    {{--else if ((Cookies.get('color-skin') == undefined) || (Cookies.get('color-skin') == 'color-1')) {--}}
    {{--$('#color-skins').attr('href', 'assets/css/color-1/color.css');--}}
    {{--}--}}
    {{--</script>--}}
</head>
<body>
<div class="body-wrapper">
@include('includes.mobile_header')

<!-- WRAPPER CONTENT-->
    <div class="wrapper-content">


        @include('includes.header')

        <div id="wrapper-content">

            @yield('content')

        </div>

        @include('includes.contact_form')
        @include('includes.subscriber_footer')

        @include('includes.footer')

    </div>
</div>
<!-- Go to addthis dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a3f920f17cb175e"></script>
<!-- Go to addthis dashboard to customize your tools -->
</body>

@section('script')
    <script>
        var lang = "{{ app()->getLocale() }}";
        var logo_str = "{{asset('storage/'.setting('site.loader'))}}";
        var active_currency = "{{session('valuta_marka')}}";
    </script>
    <script src="{{asset('assets/libs/slick-slider/slick.min.js')}}"></script>
    {{--new---------------------------------------------------------------}}
    <script src="{{asset('assets/js/jquery.youtubebackground.js')}}"></script>

    {{--======================================  VIDEO  ==============================--}}
    @if(isset($video) && $video->count() > 0)
        @php
            $ids = explode('/', $video->video_id);
            $newId = explode('?',end($ids));
        if (isset($newId[0])){
            $id = $newId[0];
        }else{
            $id = end($ids);
        }
        @endphp
    @else
        @php($id = '4OfexNs7nbY')
    @endif
    <script>
        jQuery(function ($) {
            $('#module-video').YTPlayer({
                fitToBackground: false,
                videoId: '{{$id}}',
                pauseOnScroll: false,
                playerVars: {
                    modestbranding: 0,
                    autoplay: 1,
                    controls: 0,
                    showinfo: 0,
                    branding: 0,
                    rel: 0,
                    autohide: 0
                }
            });
            $('#background-video').YTPlayer({
                fitToBackground: false,
                videoId: '{{$id}}',
                pauseOnScroll: false,
            });
        });
    </script>
    {{--new---------------------------------------------------------------}}
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/libs/detect-browser/browser.js')}}"></script>
    <script src="{{asset('assets/libs/smooth-scroll/jquery-smoothscroll.js')}}"></script>
    <script src="{{asset('assets/libs/wow-js/wow.min.js')}}"></script>
    <script src="{{asset('assets/libs/selectbox/js/jquery.selectbox-0.2.js')}}"></script>
    <script src="{{asset('assets/libs/please-wait/please-wait.min.js')}}"></script>
    <script src="{{asset('assets/libs/fancybox/js/jquery.fancybox.js')}}"></script>
    <script src="{{asset('assets/libs/fancybox/js/jquery.fancybox-buttons.js')}}"></script>
    <script src="{{asset('assets/libs/fancybox/js/jquery.fancybox-thumbs.js')}}"></script>

    <!--script(src="assets/libs/parallax/jquery.data-parallax.min.js")-->
    <!-- MAIN JS-->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <!-- LOADING JS FOR PAGE-->
    <script src="{{asset('assets/js/pages/about-us.js')}}"></script>
    @if(Request::url() == route('home'))
        <script src="{{asset('assets/js/pages/home-page.js')}}"></script>
    @endif
    @if(Request::url() == route('tour',['slug' => (isset($tour) ? $tour->slug : false)]))
        {{--        <script src="{{asset('assets/js/pages/hotel-view.js')}}"></script>--}}
        <script src="{{asset('assets/js/pages/tour-view.js')}}"></script>
        <script src="{{asset('assets/libs/isotope/isotope.min.js')}}"></script>
        <script src="{{asset('assets/libs/mouse-direction-aware/jquery.directional-hover.js')}}"></script>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.ru.min.js"></script>
    <script src="{{asset('assets/libs/nst-slider/js/jquery.nstSlider.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/sidebar.js')}}"></script>
    @if(Request::url() == route('hotel',['slug' => (isset($hotel) ? $hotel->slug : false)]) ||
     Request::url() == route('apartment',['slug' => (isset($apartment) ? $apartment->slug : false)]))
        <script src="{{asset('assets/js/pages/hotel-view.js')}}"></script>
        <script src="http://maps.googleapis.com/maps/api/js?key={{ config('voyager.googlemaps.key')}}&language={{app()->getLocale()}}"></script>
    @endif
    @if(Request::segment(1) == 'hotels' || Request::segment(2) == 'hotels')
        <script src="{{asset('assets/js/pages/hotel-result.js')}}"></script>
    @endif


    <script>
        @if(session('alert-type'))
        @if (session('alert-type') == 'success')
        toastr.success("{{session('message')}}");
        @elseif(session('alert-type') == 'error')
        toastr.error("{{session('message')}}");
        @endif
                @endif

            window.loading_screen = window.pleaseWait(
            {
                logo: logo_str,
                backgroundColor: '#fff',
                loadingHtml: "<div class='spinner sk-spinner-wave'><div class='rect1'></div><div class='rect2'></div><div class='rect3'></div><div class='rect4'></div><div class='rect5'></div></div>",
            });
        jQuery(window).load(function () {
            window.loading_screen.finish();
        });
    </script>
@show
<script src="{{asset('js/init.js')}}"></script>
</html>
