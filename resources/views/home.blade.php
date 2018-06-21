@extends('layouts.app')

@section('content')
    {{--======================================  VIDEO  ==============================--}}


    <div class="main-content">
        <section class="page-banner homepage-default">
            <!--video-->
            <div id="background-video" class="background-video">

            </div>

            <!--video-->
            <div class="container">
                <div class="homepage-banner-warpper">
                    <div class="homepage-banner-content">
                        <div class="group-title">
                            <h1 class="title">{{$video->translate()->text_1 ? $video->translate()->text_1 : 'TRAVEL ARMENIA'}}</h1>
                            <p class="text">{{$video->translate()->text_2 ? $video->translate()->text_2 : 'The world IS YOURS'}} <span class="boder"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="tab-search tab-search-long tab-search-default">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul role="tablist" class="nav nav-tabs">
                                <li role="presentation"
                                    class="tab-btn-wrapper">
                                    <a href="#tours" aria-controls="tours" role="tab"
                                       data-toggle="tab" class="tab-btn">
                                        <i class="flaticon-people"></i>
                                        <span class="text">@lang('header.tours')</span>
                                        <span class="xs">@lang('tours.find')</span>
                                    </a>
                                </li>
                                <li role="presentation" class="tab-btn-wrapper">
                                    <a href="#hotel" aria-controls="hotel" role="tab" data-toggle="tab" class="tab-btn">
                                        <i class="flaticon-three"></i>
                                        <span class="text">@lang('header.hotels')</span>
                                        <span class="xs">@lang('hotels.find')</span>
                                    </a>
                                </li>
                                <li role="presentation" class="tab-btn-wrapper">
                                    <a href="#excursion" aria-controls="transfer" role="tab" data-toggle="tab"
                                       class="tab-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                             width="24" height="24"
                                             viewBox="0 0 252 252"
                                             style="fill:#ffdd00;">
                                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1"
                                               stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                               stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                               font-weight="none" font-size="none" text-anchor="none"
                                               style="mix-blend-mode: normal">
                                                <path d="M0,252v-252h252v252z" fill="none"></path>
                                                <g id="original-icon" fill="#ffdd00">
                                                    <g id="surface1">
                                                        <path d="M141.75,0c-14.47851,0 -26.25,11.77149 -26.25,26.25c0,14.47851 11.77149,26.25 26.25,26.25c14.47851,0 26.25,-11.77149 26.25,-26.25c0,-14.47851 -11.77149,-26.25 -26.25,-26.25zM92.85938,52.5c-8.4082,0.20508 -18.45703,1.64063 -27.89062,9.51563c-12.5918,10.5 -20.87695,28.3418 -22.96875,42c-2.0918,12.5918 7.21875,16.85742 17.71875,20.01563c10.5,3.1582 20.2207,-1.18945 22.3125,-8.53125c3.1582,-9.43359 18.70313,-63 18.70313,-63c-2.3789,0 -5.08594,-0.08203 -7.875,0zM111.23438,54.46875l-20.01562,68.25c-2.0918,12.5918 -2.0918,22.3125 10.5,32.8125l34.78125,28.54688v57.42188c-0.04101,3.77344 1.92774,7.30079 5.20899,9.22851c3.28125,1.88672 7.30078,1.88672 10.58203,0c3.28125,-1.92773 5.25,-5.45508 5.20899,-9.22851v-63c0.08204,-2.78906 -0.98437,-5.53711 -2.95312,-7.54687l-1.3125,-0.98437l-25.26562,-32.48437l11.48438,-46.92187l21,21.65625c3.11719,3.32226 8.03906,4.22461 12.14063,2.29688l26.90625,-13.45312v150.9375h10.5v-156.1875l4.59375,-2.29687c4.34766,-2.17383 6.64454,-7.05469 5.57813,-11.8125c-1.10742,-4.75781 -5.29101,-8.12109 -10.17187,-8.20312v-10.5h-10.5v14.4375l-29.53125,14.76563l-25.26562,-26.25c-0.12305,-0.24609 -0.49219,-0.45117 -0.65625,-0.65625c-0.20508,-0.24609 -0.41015,-0.45117 -0.65625,-0.65625c-1.59961,-1.68164 -4.01953,-2.99414 -5.90625,-3.60937zM89.25,153.23438l-5.25,33.14063v0.65625l-20.34375,50.53125c-2.17383,5.45508 0.45117,11.60742 5.90625,13.78125c5.45508,2.17383 11.60742,-0.45117 13.78125,-5.90625l20.34375,-50.85937c0.28711,-0.49219 0.45117,-1.10742 0.65625,-1.64062c0.28711,-0.61524 0.49219,-1.3125 0.65625,-1.96875l0.32813,-0.98437l3.9375,-13.45312c-13.6582,-11.5664 -20.01562,-15.95508 -20.01562,-23.29687z"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="text">@lang('header.excursions')</span>
                                        <span class="xs">FIND EXCURSION</span>
                                    </a>
                                </li>
                                <li role="presentation"
                                    class="tab-btn-wrapper">
                                    <a href="#car-transport" aria-controls="car-rent"
                                       role="tab" data-toggle="tab" class="tab-btn">
                                        <i class="flaticon-transport-7"></i>
                                        <span class="text">@lang('header.transports')</span>
                                        <span class="xs">FIND CAR RENT</span>
                                    </a>
                                </li>
                                <li role="presentation"
                                    class="tab-btn-wrapper">
                                    <a href="#apartments" aria-controls="car-rent"
                                       role="tab" data-toggle="tab" class="tab-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                             width="24" height="24"
                                             viewBox="0 0 252 252"
                                             style="fill:#ffdd00;">
                                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1"
                                               stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                               stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                               font-weight="none" font-size="none" text-anchor="none"
                                               style="mix-blend-mode: normal">
                                                <path d="M0,252v-252h252v252z" fill="none"></path>
                                                <g id="original-icon" fill="#ffdd00">
                                                    <g id="surface1">
                                                        <path d="M126,10.5l-126,84c0,6.31641 9.4336,10.5 21,10.5c11.56641,0 21,-4.18359 21,-10.5c0,8.4082 11.56641,15.75 26.25,15.75c14.6836,0 26.25,-7.3418 26.25,-15.75c0,11.56641 13.6582,21 31.5,21c17.8418,0 31.5,-9.43359 31.5,-21c0,8.4082 11.56641,15.75 26.25,15.75c14.6836,0 26.25,-7.3418 26.25,-15.75c0,6.31641 9.4336,10.5 21,10.5c11.56641,0 21,-4.18359 21,-10.5zM40.03125,111.23438c-5.25,3.1582 -11.68945,4.26563 -19.03125,4.26563c-4.18359,0 -7.3418,0.08204 -10.5,-0.98437v126.98438h231v-126.98437c-3.1582,1.06641 -6.3164,0.98438 -10.5,0.98438c-4.18359,0 -7.3418,0.08204 -10.5,-0.98437v84.98438h-63v-84c-7.3418,6.31641 -18.9082,10.5 -31.5,10.5c-13.6582,0 -25.14258,-4.14258 -32.48437,-11.48437c-6.3164,4.1836 -14.76562,6.23438 -25.26562,6.23438c-11.5664,0 -21.90234,-3.19921 -28.21875,-9.51562zM52.5,147h63v42h-63z"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="text">@lang('header.apartments')</span>
                                        <span class="xs">FIND APARTMENT</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="tab-content">
                                    @include('includes.find_tours')
                                    @include('includes.find_hotels')
                                    @include('includes.find_excursion')
                                    @include('includes.find_transport')
                                    @include('includes.find_apartment')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>





        <section class="about-us layout-1 padding-top padding-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="group-title">
                            <div class="sub-title">
                                <p class="text">@lang('home.section_name.about')</p><i class="icons flaticon-people"></i></div>
                            <h2 class="main-title">{{$about_text->translate()->title}}</h2></div>
                        <div class="about-us-wrapper">
                            <p class="text">
                                {!! str_limit($about_text->translate()->text,1500) !!}
                            </p>

                            <div class="group-button">
                                <a href="{{route('about',['link' => 'us'])}}" class="btn">
                                    @lang('home.button.about')
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">

                        @php $images = json_decode($about_images->images, true); @endphp

                        <div data-wow-delay="0.5s" class="about-us-image wow zoomIn"><img
                                    src="{{Voyager::image($images[0])}}"
                                    alt="{{$about_images->translate()->name}}"
                                    title="{{$about_images->translate()->name}}"
                                    class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="tours padding-top padding-bottom">
            <div class="container">
                <div class="tours-wrapper">
                    <div class="group-title">
                        <div class="sub-title">
                            <p class="text">@lang('home.section_name.tours')</p><i class="icons flaticon-people"></i></div>
                        <h2 class="main-title">@lang('home.section_title.tours')</h2>
                    </div>

                    <div class="tours-content margin-top70">
                        <div class="tours-list">
                            @foreach($tours as $tour)
                                @include('tours.tour_item')
                            @endforeach

                        </div>
                        <a href="about-us.html" class="btn btn-transparent margin-top70">@lang('home.button.tours')</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="hotels padding-top padding-bottom">
            <div class="container">
                <div class="hotels-wrapper">
                    <div class="group-title">
                        <div class="sub-title">
                            <p class="text">@lang('home.section_name.hotels')</p><i class="icons flaticon-people"></i></div>
                        <h2 class="main-title">@lang('home.section_title.hotels')</h2></div>
                    <div class="hotels-content margin-top70">
                        <div class=" hotels-list ">
                            @foreach($hotels as $hotel)
                                <div class="">
                                    <div class="hotels-layout">
                                        <div class="image-wrapper">
                                            <a href="{{route('hotel',['slug' => $hotel->slug])}}"
                                               class="link">
                                                <img src="{{asset(Voyager::image($hotel->thumbnail('tumb')))}}"
                                                     alt="{{$hotel->translate('en')->name}}"
                                                     class="img-responsive width-100">
                                            </a>
                                            @include('hotels.sale')
                                            <div class="title-wrapper">
                                                <a href="{{route('hotel',['slug' => $hotel->slug])}}" class="title">
                                                    {{$hotel->translate()->name}}
                                                </a>
                                                @if($hotel->star != 'null' && $hotel->star != null && $hotel->star)
                                                    <div title="Rated {{$hotel->star}} out of 5"
                                                         class="star-rating">
                                                                <span class="width-{{20 * $hotel->star}}">

                                                                </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="content-wrapper">
                                            <div class="content">
                                                <div class="title">
                                                    @include('hotels.pricing')
                                                </div>
                                                {!! $hotel->translate()->short_description !!}
                                                <div class="group-btn-tours">
                                                    <a href="{{route('hotel',['slug' => $hotel->slug])}}"
                                                       class="left-btn">
                                                        book now
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="about-us.html" class="btn btn-transparent margin-top70">@lang('home.button.hotels')</a></div>
                </div>
            </div>
        </section>

        <section class="travelers">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="traveler-wrapper padding-top padding-bottom">
                            <div class="group-title white">
                                <div class="sub-title">
                                    <p class="text">@lang('home.section_name.reviews')</p><i class="icons flaticon-people"></i>
                                </div>
                                <h2 class="main-title">@lang('home.section_title.reviews')</h2></div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="traveler-list single-item">
                            @foreach($reviews as $review)
                                @if(!empty($review->images))
                                    @php $images = json_decode($review->images, true) @endphp
                                    @if(isset($images[0]))
                                        @php $image = Voyager::image(str_replace('.jpg','-tumb.jpg', $images[0])) @endphp
                                    @endif
                                @else
                                    @php $image = asset('storage/comments/default_cover.jpeg') @endphp
                                @endif
                                <div class="traveler">
                                    <div class="cover-image">
                                        <img src="{{$image}}"
                                             alt="{{config('app.name')}}" width="100%">
                                    </div>

                                    <div class="wrapper-content">
                                        <div class="avatar">
                                            <img src="{{$image}}" alt=""
                                                 class="{{config('app.name')}}">
                                        </div>
                                        <p class="name">{{$review->user_name}}</p>
                                        <p class="address">{{$review->uaer_country}}</p>
                                        <p class="description">{!! str_limit($review->text,300) !!}</p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="news padding-top padding-bottom">
            <div class="container">
                <div class="news-wrapper">
                    <div class="group-title">
                        <div class="sub-title">
                            <p class="text">@lang('home.section_name.blog')</p><i class="icons flaticon-people"></i></div>
                        <h2 class="main-title">@lang('home.section_title.blog')</h2></div>
                    <div class="news-content margin-top70">
                        <div class="news-list news-lists">
                            @foreach($posts as $post)
                                <div class="new-layout">
                                    <div class="image-wrapper">
                                        <a href="#" class="link">
                                            <img src="{{Voyager::image($post->thumbnail('tumb'))}}"
                                                 alt="{{$post->translate()->title}}"
                                                 title="{{$post->translate()->title}}"
                                                 class="img-responsive">
                                        </a>
                                        <div class="description">
                                            {{$post->translate()->title}}
                                        </div>
                                    </div>
                                    <div class="content-wrapper">
                                        <a href="#" class="title">
                                            {{$post->translate()->title}}
                                        </a>

                                        @php
                                            $date = explode(' ', $post->created_at);
                                            $date = explode('-', $date[0]);
                                            $dateObj   = DateTime::createFromFormat('!m', $date[1]);
                                            $monthName = $dateObj->format('F');
                                        @endphp
                                        <ul class="info list-inline list-unstyled">
                                            <li><a href="#"
                                                   class="link">{{strtoupper($monthName).' '.$date[2].', '.$date[0]}}</a>
                                            </li>
                                        </ul>
                                        {!! $post->translate()->excerpt  !!}
                                        <div class="">
                                            <a href="{{route('blog_detail', ['slug' => $post->slug])}}"
                                               class="btn btn-maincolor">
                                                @lang('home.button.blog')
                                            </a>
                                        </div>
                                        @if(isset($post->heightags) && $post->heightags->count() > 0)
                                            <div class="tags">
                                                <div class="title-tag">tags:</div>
                                                <ul class="list-inline list-unstyled list-tags">
                                                    @foreach($post->heightags as $heightag)
                                                        <li>
                                                            <a href="{{route('blog',
                                                    ['tag_name' => $heightag->translate()->name])}}"
                                                               class="tag">
                                                                {{$heightag->translate()->name}}
                                                            </a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="a-fact padding-top padding-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="group-title">
                            <div class="sub-title">
                                <p class="text">PROUD NUMBERS</p><i class="icons flaticon-people"></i></div>
                            <h2 class="main-title">a fact of explooer</h2></div>
                        <div class="a-fact-wrapper">
                            <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                veniam, by injected humour. </p>
                            <div class="a-fact-list">
                                <ul class="list-unstyled">
                                    <li>
                                        <p class="text">1456 flight in the world.</p>
                                    </li>
                                    <li>
                                        <p class="text">2385 happy customer enjoy jouneys with Explooer.</p>
                                    </li>
                                    <li>
                                        <p class="text">356 best destinational we explore.</p>
                                    </li>
                                    <li>
                                        <p class="text">2345 package tours every year.</p>
                                    </li>
                                    <li>
                                        <p class="text">top 10 best tourism services.</p>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" class="btn btn-maincolor">read more</a></div>
                    </div>
                    <div class="col-md-8">
                        <div class="a-fact-image-wrapper">
                            <div class="a-fact-image">
                                <a href="{{route('tours','georgia')}}" class="icons icons-1">
                                    <i class="fa fa-map-marker"></i>
                                </a>
                                <img src="{{asset('storage/map/georgia.png')}}"
                                        alt="Georgia" class="img-responsive">
                            </div>
                            <div class="a-fact-image">
                                <a href="{{route('tours','armenia')}}" class="icons icons-2">
                                    <i class="fa fa-map-marker"></i>
                                </a>
                                <img src="{{asset('storage/map/armenia.png')}}" alt="Armrnia" class="img-responsive">
                            </div>
                            <div class="a-fact-image">
                                <a href="{{route('tours','artsagh')}}" class="icons icons-3">
                                    <i class="fa fa-map-marker"></i>
                                </a>
                                <img src="{{asset('storage/map/artsagh.png')}}"
                                        alt="Artsagh" class="img-responsive">
                            </div>
                            <!--                            <div class="a-fact-image"><a href="#" class="icons icons-4"><i class="fa fa-suitcase"></i></a><img src="assets/images/homepage/area-4.png" alt="" class="img-responsive"></div>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection