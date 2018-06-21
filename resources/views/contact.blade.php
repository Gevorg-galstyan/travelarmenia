@extends('layouts.app')

@section('meta')
    @if($coverImage->seo_title)
        <title>{{$coverImage->seo_title}}</title>
        <meta name="description" content="{{$coverImage->meta_description}}">
        <meta name="keywords" content="{{$coverImage->meta_keywords}}">
    @else
        @parent
    @endif
@endsection


@section('content')
    <div class="main-content">
        <section class="page-banner about-us-page"
                 style="background-image: url({{asset('storage/'.($coverImage->image ?? 'cover.jpg'))}})">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li class="active"><a href="#" class="link">@lang('header.contact')</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">@lang('header.contact')</h2></div>
                </div>
            </div>
        </section>
       @include('includes.experts')

        <section class="page-contact-map">
            <div class="map-block">
                <div class="wrapper-info">
                    <div class="map-info">
                        <h3 class="title-style-2">@lang('contact.how_to_find_us')</h3>
                        <p class="address"><i class="fa fa-map-marker"></i>
                            {{setting('site.adderss')}}
                        </p>
                        <p class="phone"><i class="fa fa-phone"></i>
                            {{setting('site.email')}}
                        </p>
                        <p class="mail">
                            <a href="mailto:domain@expooler.com"> <i class="fa fa-envelope-o"></i>
                                {{setting('site.phone')}}
                            </a>
                        </p>
                        <div class="footer-block"><a class="btn btn-open-map">@lang('contact.open_map')</a></div>
                    </div>
                </div>
                <div id="googleMap"></div>
            </div>
        </section>
    </div>
    <!-- BUTTON BACK TO TOP-->
    <div id="back-top"><a href="#top" class="link"><i class="fa fa-angle-double-up"></i></a></div>
@endsection
@section('script')
    <script>
        var latitude = parseFloat({{setting('site.latitude')}});
        var longitude = parseFloat({{setting('site.longitude')}});
        var email = "{{setting('site.email')}}";
        var phone = "{{setting('site.phone')}}";
        var address = "{{setting('site.adderss')}}";
    </script>
    @parent
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCGlulseGnpwtfqy6sBtT0UnF6__vPYIvc&language={{session('locale')}}
            "></script>
    <script src="{{asset('assets/js/pages/contact.js')}}"></script>
    {!! app('captcha')->renderJs(session('locale')) !!}
    @if(session('alert-type') && session('alert-type') == 'error')
        <script>
            $('html, body').animate({
                scrollTop: $(".scroll-to").offset().top - $('.header-main').height()
            });
        </script>
    @endif
@endsection