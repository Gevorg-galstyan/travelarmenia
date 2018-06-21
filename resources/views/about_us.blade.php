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
                            <li class="active"><a href="#" class="link">@lang('about.about_us')</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">@lang('about.about_us')</h2></div>
                </div>
            </div>
        </section>
        <section class="about-us layout-2 padding-top padding-bottom about-us-4">
            <div class="container">
                @foreach($abouts as $j => $about)
                    <div class="row">
                        <div class="wrapper-contact-style">
                            <div class="col-sm-6 about-text">
                                <h3 class="title-style-2">{{$about->translate()->title}}</h3>
                                <div class="about-us-wrapper">
                                    <p class="text">
                                        {!! $about->translate()->text !!}
                                    </p>
                                    <div class="group-list">

                                        @foreach($about->items as $i => $item)
                                            <div class="panel ">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                        <a data-toggle="collapse"
                                                           data-parent="#accordion-1"
                                                           href="#collapse-{{$i.'-'.$j}}" aria-expanded="false"
                                                           class="accordion-toggle collapsed ">
                                                            {!! $item->translate()->name !!}
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapse-{{$i.'-'.$j}}" role="tabpanel" aria-expanded="false"
                                                     style="height: 0px"
                                                     class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        {!! $item->translate()->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 about-images">
                                <div class="car-rent-layout">
                                    @if($j == 0)

                                            @php($clear = 0)
                                            @foreach($about_images as $image)
                                                @php($images = json_decode($image->images, true))
                                                @foreach($images as $img)
                                                    @if(is_int($clear/3))
                                                        {{--<div class="clearfix"></div>--}}
                                                    @endif
                                                    <div class="col-lg-4">
                                                        <div class="hovereffect">
                                                            <img src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                                                                 alt="{{$image->translate()->name}}"
                                                                 title="{{$image->translate()->name}}"
                                                                 width="100%">
                                                            <a href="{{Voyager::image($img)}}"
                                                               title="{{$image->translate()->name}}"
                                                               data-fancybox-group="gallery-city-{{$i}}"
                                                               class="wp-gallery glry-absolute fancybox thumb">
                                                                <div class="overlay">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @php($clear ++)
                                                @endforeach
                                            @endforeach

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @include('includes.experts')
        <section class="about-banner padding-top  padding-bottom-50">
            <div class="container">
                <h3 class="title-style-2">@lang('about.our_partners')</h3>
                <div class="wrapper-banner">
                    @foreach($partners->chunk(2) as $chunk)
                        <div class="content-banner">
                            @foreach($chunk as $partner)
                                <a href="{{$partner->link}}" target="_blank" title="{{$partner->name}}"
                                   class="img-banner">
                                    <img src="{{Voyager::image($partner->image)}}"
                                         alt="{{$partner->translate()->name}}" class="img-responsive">
                                </a>
                            @endforeach
                        </div>
                    @endforeach
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
        @if(session('error'))
        $('html, body').animate({
            scrollTop: $(".scroll-to").offset().top - $('.header-main').height()
        });
        @endif
        $(document).ready(function () {
            var about_height = $('.about-text').height();
            if ($('.about-images').height() > about_height) {
                $('.about-images').height(about_height).css('overflow', 'scroll');
            }
        });
    </script>
@endsection
