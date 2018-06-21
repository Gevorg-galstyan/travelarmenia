@extends('layouts.app')
@section('meta')
    <title>{{'About'.$country->seo_title}}</title>
    <meta name="description" content="{{$country->meta_description}}">
    <meta name="keywords" content="{{$country->meta_keywords}}">
@endsection

@section('content')
    <div class="main-content">
        <section class="page-banner about-us-page"
                 style="background-image: url({{asset('storage/'.($country->image ?? 'cover.jpg'))}})">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li class="active"><a href="#" class="link">{{__('about.country.'.$country->id)}}</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">{{__('about.country.'.$country->id)}}</h2></div>
                </div>
            </div>
        </section>
        <section class="about-us layout-2 padding-top padding-bottom about-us-4">
            <div class="container">
                <div class="row">
                    <div class="wrapper-contact-style">
                        <div class="col-sm-6 about-text">
                            <h3 class="title-style-2">{{$country->translate()->name}}</h3>
                            <div class="about-us-wrapper">
                                <p class="text">
                                    {!! $country->translate()->description !!}
                                </p>
                                <div class="group-list">

                                    @foreach($country->cities as $i => $city)
                                        <div class="panel" id="{{$city->slug}}">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    <a data-toggle="collapse"
                                                       data-parent="#accordion-1"
                                                       href="#collapse-{{$city->slug}}" aria-expanded="false"
                                                       class="accordion-toggle collapsed ">
                                                        {!! $city->translate()->name .($city->capital == 1 ? 'CAPITAL' : '')!!}
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse-{{$city->slug}}" role="tabpanel" aria-expanded="false"
                                                 style="height: 0px"
                                                 class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p>
                                                        {!! $city->translate()->description !!}
                                                    </p>
                                                    <div class="car-rent-layout">
                                                        @foreach($city->images as $chunk)
                                                            @php($images = json_decode($chunk->image, true))

                                                            <div class="row">
                                                                @foreach($images as $img)
                                                                    <div class="col-lg-2">
                                                                        <div class="hovereffect">
                                                                            <img src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                                                                                 alt="{{$chunk->translate()->name}}"
                                                                                 title="{{$chunk->translate()->name}}"
                                                                                 width="100%">
                                                                            <a href="{{Voyager::image($img)}}"
                                                                               title="{{$chunk->translate()->name}}"
                                                                               data-fancybox-group="gallery-city-{{$i}}"
                                                                               class="wp-gallery glry-absolute fancybox thumb">
                                                                                <div class="overlay">
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 about-images">
                            <div class="car-rent-layout">
                                @foreach($country->images as $chunk)
                                    @php($images = json_decode($chunk->image, true))
                                    <div class="row">
                                        @foreach($images as $img)
                                            <div class="col-lg-4">
                                                <div class="hovereffect">
                                                    <img src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                                                         alt="{{$chunk->translate()->name}}"
                                                         title="{{$chunk->translate()->name}}"
                                                         width="100%">
                                                    <a href="{{Voyager::image($img)}}"
                                                       title="{{$chunk->translate()->name}}"
                                                       data-fancybox-group="gallery-country"
                                                       class="wp-gallery glry-absolute fancybox thumb">
                                                        <div class="overlay">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{--@include('includes.contact_form')--}}

    </div>
    <!-- BUTTON BACK TO TOP-->
    <div id="back-top"><a href="#top" class="link"><i class="fa fa-angle-double-up"></i></a></div>
@endsection

@section('script')

    @parent
    {!! app('captcha')->renderJs(session('locale')) !!}
    <script>
        @if(session('alert-type') && session('alert-type') == 'error')

        $('html, body').animate({
            scrollTop: $(".scroll-to").offset().top - $('.header-main').height()
        });
        @endif
        @if($city_link)
        $('#collapse-' + '{{$city_link}}').collapse();
        $('#collapse-' + '{{$city_link}}').find('.panel-body').addClass('background_panel');
        setTimeout(function () {
            $('#collapse-' + '{{$city_link}}').find('.panel-body').removeClass('background_panel');
        }, 6000);
        $(window).load(function () {
            $('html, body').animate({
                scrollTop: $('{{'#'.$city_link}}').offset().top - $('.header-main').height()
            });
        });

        @endif
    </script>
@endsection