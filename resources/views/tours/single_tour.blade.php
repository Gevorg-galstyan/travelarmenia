@extends('layouts.app')

@section('meta')
    <title>{{$tour->seo_title}}</title>
    <meta name="description" content="{{$tour->meta_description}}">
    <meta name="keywords" content="{{$tour->meta_keywords}}">
@endsection

@section('link')
    @parent
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    {{--{!! NoCaptcha::renderJs(session('locale'), true, 'recaptchaCallback') !!}--}}
@endsection

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <section class="page-banner tour-view"
                 style="background-image: url({{asset('storage/'.$tour->image)}});">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li>
                                <a href="{{route('tours',['country' => $tour->country->slug])}}" class="link">
                                    @if($tour->country)
                                        {{__('tours.in.'.$tour->country->id)}}
                                    @else
                                        {{$tour->country->translate()->name}}
                                    @endif
                                </a>
                            </li>
                            <li class="active">
                                <a href="#" class="link">
                                    {{$tour->translate()->title}}
                                </a>
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">{{($tour->translate()->title)}}</h2>
                        <div class="price">
                            @if($tour->pricing)
                                <span class="text">from</span>
                            @else
                                <span class="text">Per Person</span>
                            @endif
                            @include('tours.price',['tour' => $tour])
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="tour-view-main padding-top padding-bottom">
                <div class="container">
                    <h2 class="title-style-2">{{$tour->translate()->title}}
                        @if($tour->sale)
                            <span> (sale off {{$tour->sale}}%)</span>
                        @endif
                    </h2>
                    <div class="schedule-block">
                        <div class="element">
                            <p class="schedule-title">Date</p>
                            @if($tour->check_in)
                                @php
                                    $check_ins = explode('/', $tour->check_in);
                                    $check_outs = explode('/', $tour->check_out);
                                @endphp
                                @foreach($check_ins as $i =>$check_in)
                                    <span>{{$check_in.' - '.$check_outs[$i]}}</span>
                                @endforeach
                            @else
                                <div class="schedule-content">
                                    @lang('tours.single.all_year_round')
                                </div>
                            @endif
                        </div>

                        <div class="element">
                            <p class="schedule-title">Duration</p>
                            <span class="schedule-content">
                                    {{$tour->destinations->count() ?? 1}} Day
                                </span>
                        </div>
                        <div class="element">
                            <a href="#reviews">
                                <p class="schedule-title">Reviews</p>
                                <span class="schedule-content">
                                {{$tour->comments->where('public', 1)->count()}}
                                </span>
                            </a>
                        </div>

                        @if($tour->available > 0)
                            <div class="element">
                                <p class="schedule-title">Availability</p>
                                <span class="schedule-content">
                                {{'('.($tour->available ? $tour->available : 0).'-'.$orederCount.') '.$available }}
                            </span>
                            </div>
                        @endif
                    </div>
                    <div class="journey-block margin-top70">
                        <h3 class="title-style-3">@lang('tours.single.tour_types')</h3>
                        <div class="wrapper-journey">
                            @foreach($tour->types as $type)
                                <div class="item feature-item">
                                    <span style="display: inline-flex;">{!! $type->icon !!}</span>
                                    <p class="text">{{$type->translate()->name}}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="car-rent-layout">
                                <div class="content-wrapper">
                                    {!! $tour->translate()->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="overview-block clearfix">
                            <h3 class="title-style-3">@lang('tours.single.tour_overview')</h3>
                            <div class="timeline-container">
                                <div class="timeline">
                                    @foreach($tour->destinations as $day => $destination)
                                        <div class="timeline-block">
                                            <div class="timeline-title"><span>@lang('tours.single.day') {{$day + 1}}</span></div>
                                            <div class="timeline-content medium-margin-top">
                                                <div class="row">
                                                    <div class="timeline-point"><i class="fa fa-circle-o"></i></div>
                                                    <div class="timeline-custom-col content-col">
                                                        <div class="timeline-location-block">
                                                            <p class="location-name">

                                                                @if($destination->city)
                                                                    <a href="{{route('about',['
                                                                    link' => $tour->country->slug,
                                                                    'city' => $destination->city->slug
                                                                    ])}}" target="_blank">
                                                                        {{$destination->translate()->title}}
                                                                    </a>
                                                                @else
                                                                    {{$destination->translate()->title}}
                                                                @endif
                                                                <i class="fa fa-map-marker icon-marker"></i>
                                                            </p>
                                                            <p class="description">
                                                                {!! $destination->translate()->description !!}
                                                            </p>
                                                        </div>
                                                    </div>


                                                    <div class="timeline-custom-col">
                                                        <div class="image-hotel-view-block">
                                                            <div class="slider-for slider-for">
                                                                @foreach($destination->images as $image)
                                                                    @php($images = json_decode($image->images, true))
                                                                    @foreach($images as $img)
                                                                        <div class="item hovereffect">
                                                                            <img src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                                                                                 alt="{{$image->translate()->image_name}}"
                                                                                 title="{{$image->translate()->image_name}}">
                                                                            <a href="{{Voyager::image($img)}}"
                                                                               data-fancybox-group="gallery-{{$day}}"
                                                                               title="{{$image->translate()->image_name}}"
                                                                               class="wp-gallery glry-absolute fancybox thumb">
                                                                                <div class="overlay">
                                                                                </div>
                                                                            </a>
                                                                        </div>

                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                            <div class="slider-nav">
                                                                @foreach($destination->images as $image)
                                                                    @php($images = json_decode($image->images, true))
                                                                    @foreach($images as $img)
                                                                        <div class="item">
                                                                            <img src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                                                                                 alt="{{$image->translate()->image_name}}"
                                                                                 title="{{$image->translate()->image_name}}">
                                                                        </div>
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--<div class="timeline-custom-col image-col">--}}
                                                    {{--<div class="timeline-image-block"><img--}}
                                                    {{--src="assets/images/tour-view/timeline/london.png"--}}
                                                    {{--alt=""></div>--}}
                                                    {{--</div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($tour->pricing)
                        @php($data = json_decode($tour->pricing->details,true))
                        <div class="container">
                            <h2>@lang('tours.single.price_table')</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr class="find-widget text-center">
                                        <th>@lang('tours.single.hotel_name')</th>
                                        @foreach($data[0]['column'] as $key => $column)
                                            <th>{{$column['title']}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $j => $row)
                                        <tr>
                                            <td>
                                                @if($row['hotel_slug'])
                                                    <a target="_blank " class="btn"
                                                       href="{{ route('hotel',['slug' => $row['hotel_slug']])}}">
                                                        {{ $row['hotel_'.app()->getLocale().'_name'] }}
                                                    </a>
                                                @else
                                                    <button class="btn">
                                                        {{ $row['hotel_'.app()->getLocale().'_name'] }}
                                                    </button>
                                                @endif
                                            </td>
                                            @foreach($data[$j]['column'] as $i => $column)
                                                <td class=" btn-book-tour pointer"
                                                    data-href="{{route('get_tour_book',['slug' => $tour->slug])}}"
                                                    data-column="{{$i}}"
                                                    data-row="{{$j}}">
                                                    {{$column['value']}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    @if($hotels->count())
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <select name="rest_hotel" data-width="auto"
                                                            class=" selectpicker show-tick rest_hotel pull-left">
                                                        @foreach($hotels as $hotel)
                                                            <option value="{{$hotel->slug}}"
                                                                    class="text-center"
                                                                    data-href="{{route('hotel',['slug' => $hotel->slug])}}">
                                                                {{$hotel->translate()->name}}
                                                            </option>
                                                            @if(!isset($rest_url))
                                                                @php($rest_url = route('hotel',['slug' => $hotel->slug]))
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <a href="{{isset($rest_url) ? $rest_url : '#0'}}" target="_blank"
                                                       class="see btn">
                                                        @lang('tours.single.see_the_hotel')
                                                    </a>
                                                </div>
                                            </td>
                                            @foreach($data[$j]['column'] as $i => $column)
                                                <td class="pointer btn-book-tour"
                                                    data-column="{{$i}}"
                                                    data-href="{{route('get_tour_book',['slug' => $tour->slug])}}">
                                                    {{$column['title']}}
                                                    <dfn data-info="sdadasdasd"> ?</dfn>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="wrapper-btn margin-top70">
                            <button class="btn btn-maincolor btn-book-tour"
                                    data-href="{{route('get_tour_book',['slug' => $tour->slug])}}">
                                @lang('tours.book_now')
                            </button>
                        </div>
                    @endif
                    @if($tour->translate()->price_description)
                        <div class="row">
                            <div class="car-rent-layout">
                                <div class="content-wrapper">
                                    {!! $tour->translate()->price_description!!}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="timeline-book-block  book-tour">
                    </div>
                    <div class="container">
                        <div class="expert-block padding-top">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <h3 class="title-style-2">@lang('tours.single.talk_to_our_expert')</h3>
                                    <p>
                                        @lang('tours.single.expert_text')
                                    </p>
                                </div>
                                @if($tour->expert)
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="about-us-wrapper">
                                            <div class="avatar">

                                                <div class="image-wrapper">
                                                    <img src="{{asset('storage/'.$tour->expert->image)}}"
                                                         alt="{{ $tour->expert->translate()->name }}"
                                                         title="{{ $tour->expert->translate()->name }}"
                                                         class="img img-responsive"></div>
                                                <div class="content-wrapper">
                                                    <p class="name">
                                                        {{$tour->expert->translate()->name}}
                                                    </p>

                                                </div>
                                            </div>
                                            <div class="row group-list contact-list">
                                                <div class="col-sm-4 col-xs-4 col-contact">

                                                    <div class="media contact-list-media">

                                                        <div class="media-left">
                                                            <a href="skype:{{ $tour->expert->skype }}?chat"
                                                               class="icons">
                                                                <i class="fa fa-desktop"></i>
                                                            </a>

                                                        </div>

                                                        <div class="media-right">
                                                            <a href="skype:-skype-name-?chat" class="title">
                                                                @lang('tours.single.contact_skype')
                                                            </a>
                                                            <p class="text">
                                                                {{ $tour->expert->skype }}
                                                            </p>

                                                        </div>

                                                    </div>


                                                </div>
                                                <div class="col-sm-4 col-xs-4 col-contact">

                                                    <div class="media contact-list-media">
                                                        <div class="media-left">
                                                            <a href="tel:{{ $tour->expert->phone }}" class="icons">
                                                                <i class="fa fa-phone"></i>
                                                            </a>

                                                        </div>

                                                        <div class="media-right">
                                                            <a href="tel:{{ $tour->expert->phone  }}"
                                                               class="title">@lang('tours.single.phone')</a>
                                                            <p class="text">
                                                                {{ $tour->expert->phone }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4 col-xs-4 col-contact">
                                                    <div class="media contact-list-media">
                                                        <div class="media-left">
                                                            <a href="mailto:{{ $tour->expert->email }}" class="icons">
                                                                <i class="fa fa-envelope-o"></i>
                                                            </a>
                                                            <div class="media-right">
                                                                <a href="mailto:{{ $tour->expert->email }}"
                                                                   class="title">
                                                                    @lang('tours.single.email')
                                                                </a>
                                                                <p class="text">
                                                                    {{ $tour->expert->email }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="item-blog-detail">
                                <div class="blog-post blog-text">
                                    <div class="blog-comment" id="reviews">
                                        <div class="comment-count blog-comment-title sideline">
                                            {{$tour->comments->where('public', 1)->count()}}
                                            @lang('tours.single.comments')
                                        </div>
                                        <ul class="comment-list list-unstyled timeline-location-block">
                                            @foreach($tour->comments->where('public', 1)->sortByDesc('id')->slice(0,5) as $i => $comment)
                                                @include('includes.comment')
                                            @endforeach
                                            @if($tour->comments->count() > 5)
                                                <li class="text-center">

                                                    <a href="{{route('reviews',['tour_slug' => $tour->slug])}}">
                                                        <button type="button" data-hover="SEND NOW"
                                                                class="btn btn-slide">
                                                            <span class="text">
                                                                @lang('tours.single.all_comments')
                                                            </span>
                                                            <span class="icons fa fa-long-arrow-right"></span>
                                                        </button>
                                                    </a>

                                                </li>
                                            @endif
                                        </ul>

                                    </div>
                                    <div class="leave-comment">
                                        <div class="blog-comment-title sideline comments-title">
                                            @lang('review.leave_your_comment')
                                        </div>
                                        @if(session('comment_msg'))
                                            <div class="content-wrapper">
                                                <span>
                                                {{session('comment_msg')}}
                                                </span>
                                            </div>
                                        @endif

                                       @include('includes.comment_form')
                                    </div>
                                </div>
                            </div>
                            @include('tours.similar_tours')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- BUTTON BACK TO TOP-->
    <div id="back-top"><a href="#top" class="link"><i class="fa fa-angle-double-up"></i></a></div>
    @include('includes.customer_conditions')
@endsection
@section('script')
    <script>
        var total_child = '';
        var t = '';
        var pricing = '';
        {{--var available = "{{$available}}"--}}
    </script>
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    {{--{!! app('captcha')->renderJs(session('locale')) !!}--}}
    @if(session('alert-type') && session('alert-type') == 'error')
        <script>
            $('html, body').animate({
                scrollTop: $(".comments-title").offset().top - $('.header-main').height()
            });
        </script>
    @endif
    {!! app('captcha')->renderJs(session('locale'), false) !!}
@endsection
