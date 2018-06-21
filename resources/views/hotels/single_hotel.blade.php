@extends('layouts.app')
@section('meta')
    <title>{{$hotel->seo_title}}</title>
    <meta name="description" content="{{$hotel->meta_description}}">
    <meta name="keywords" content="{{$hotel->meta_keywords}}">
@endsection
@section('content')
    <!-- MAIN CONTENT-->

    <div class="main-content">
        {{--{{dd($hotel->getCoordinates())}}--}}
        <section class="page-banner hotel-view"
                 style="background-image: url({{asset('storage/'.$hotel->image)}});">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li>
                                <a href="{{route('hotels',['country' => $hotel->country->slug])}}" class="link">
                                   {{__('hotels.in.'.$hotel->country->id)}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('hotels',['country' => $hotel->country->slug, 'city' => $hotel->city->slug])}}"
                                   class="link">
                                    {{$hotel->city->translate()->name}}
                                </a>
                            </li>
                            <li class="active">
                                <a href="#" class="link">{{$hotel->translate()->name}}</a>
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">{{$hotel->translate()->name}}</h2>

                        <div class="price">
                            @include('hotels.pricing',['page' => 'single'])
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="hotel-view-main padding-top padding-bottom">
                <div class="container">
                    <div class="journey-block">
                        <h3 class="title-style-2">{{$hotel->translate()->name}}
                            <span>
                                @include('hotels.pricing',['echo_sale' => true,'page' => 'single'])
                            </span>
                        </h3>
                        <hr>

                        <div class="car-rent-layout">
                            @if($hotel->images->count())
                                @php($i = 0)
                                @foreach($hotel->images as $image)
                                    @php($images = json_decode($image->image, true))
                                    @foreach($images as $img)
                                        <div class="col-lg-2">
                                            <div class="hovereffect">
                                                <img class="img-responsive"
                                                     src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                                                     alt="{{$image->translate()->image_name}}"
                                                     title="{{$image->translate()->image_name}}"
                                                     width="100%">
                                                <a href="{{Voyager::image($img)}}"
                                                   data-fancybox-group="gallery-hotel"
                                                   title="{{$image->translate()->image_name}}"
                                                   class="wp-gallery glry-absolute fancybox thumb">
                                                    <div class="overlay">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @php($i++)
                                    @endforeach
                                    @php($i++)
                                @endforeach
                            @endif
                        </div>
                        <hr>
                        <div class="row">
                            <div class="car-rent-layout">
                                <div class="content-wrapper">
                                    {!! $hotel->translate()->description !!}
                                </div>
                            </div>
                        </div>
                        @if(count($hotel->rooms) > 0)
                            <div class="container">
                                <h2>@lang('hotels.single.price_table_to_seasons')</h2>
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr class="find-widget text-center">
                                        <th>@lang('hotels.single.rooms')</th>
                                        @foreach($hotel->seasons->sortBy('start') as $key => $season)
                                            <th>
                                                {{date("Y.d.m", strtotime($season->start)).
                                                ' - '.date("Y.d.m", strtotime($season->end))}}
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($hotel->rooms as $key => $room)
                                        <tr>
                                            <td>
                                                <div data-toggle="collapse" data-target="#room_{{$key}}"
                                                     class="timeline-title btn btn-maincolor btn-book-tour">
                                                    {{$room->translate()->name}}
                                                </div>
                                                @if($room->person_count)
                                                    {{__('hotels.single.contribution_people',['count' => $room->person_count])}}
                                                @endif
                                            </td>
                                            @foreach($hotel->seasons->sortBy('start') as  $season)
                                                <td class=" btn-book-tour pointer"
                                                    data-href="{{route('get_hotel_book',['slug' => $hotel->slug, 'room_id' => $room->id])}}"
                                                        {{--data-tour="{{$tour->id}}" data-price="{{$price->id}}"--}}
                                                >
                                                    @php($room_price = isset($room
                                                        ->seasons
                                                        ->where('seasion_id',$season->id)
                                                        ->first()
                                                        ->price) ? $room->seasons->where('seasion_id',$season->id)->first()->price : 0 )
                                                    {{--{{dd($room_price)}}--}}
                                                    @if($room_price)
                                                        @if($hotel->sale)
                                                            <del class="number price" data-name="price">
                                                                <input type="hidden" data-name="origin_price"
                                                                       value="{{$room_price}}">
                                                                <span>
                                                                {{round($room_price / (session('valuta_val')
                                                            ? session('valuta_val') : 1))}}
                                                           </span>
                                                            </del>
                                                            <span class="number price" data-name="price">
                                                            <input type="hidden" data-name="origin_price"
                                                                   value="{{($room_price -($room_price / 100 * $hotel->sale))}}">
                                                            <span>
                                                                {{round(($room_price -
                                                            ($room_price / 100 * $hotel->sale)) /
                                                            (session('valuta_val') ? session('valuta_val') : 1))}}
                                                            </span>
                                                        </span>
                                                        @else
                                                            <span class="number price" data-name="price">
                                                             <input type="hidden" data-name="origin_price"
                                                                    value="{{$room_season->price}}">
                                                            <span>{{round($room_season->price / (session('valuta_val')
                                                            ? session('valuta_val') : 1))}}</span>
                                                        </span>
                                                        @endif
                                                        <sup class="unit valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
                                                    @else
                                                        0
                                                    @endif

                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if($hotel->translate()->price_description)
                            <div class="row">
                                <div class="car-rent-layout">
                                    <div class="content-wrapper">
                                        {!! $hotel->translate()->price_description !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <h3 class="text-center" id="success-container"></h3>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="group-btn-tours">
                                    <a href=""
                                       class="timeline-title btn btn-maincolor btn-book-tour btn-book-hotel"
                                       data-target="room_">
                                        @lang('book_form.book now')
                                    </a>
                                </div>
                            </div>
                            @include('hotels.room_book')
                        </div>

                        @if(count($hotel->rooms) > 0)
                            <div class="overview-block clearfix">
                                <h3 class="title-style-3">@lang('hotels.single.rooms')</h3>
                                <div class="timeline-container">
                                    <div class="timeline">
                                        @foreach($hotel->rooms as $i => $room)
                                            <div class="timeline-block">
                                                <div data-toggle="collapse" data-target="#room_{{$i}}"
                                                     class="timeline-title btn btn-maincolor btn-book-tour">
                                                    {{$room->translate()->name}}
                                                </div>


                                                <div id="room_{{$i}}" class="room-collapse
                                            timeline-content medium-margin-top collapse  ">
                                                    <div class="row">
                                                        <div class="timeline-point"><i class="fa fa-circle-o"></i></div>
                                                        <div class="timeline-custom-col content-col hotels-layout">
                                                            <div class="content-wrapper">
                                                                <div class="content ">
                                                                    <div class="timeline-location-block">
                                                                        @include('hotels.single_price')
                                                                        {!! $room->translate()->description !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="timeline-custom-col">
                                                            <div class="image-hotel-view-block">
                                                                <div class="slider-for slider-for">
                                                                    @if($room->images)
                                                                        @php($images = json_decode($room->images, true))
                                                                        @foreach($images as $index => $img)
                                                                            <div class="item hovereffect">
                                                                                <img src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                                                                                     alt="{{$hotel->translate()->name}}"
                                                                                     title="{{$hotel->translate()->name}}">
                                                                                <a href="{{Voyager::image($img)}}"
                                                                                   data-fancybox-group="gallery-{{$i}}"
                                                                                   alt="{{$room->translate()->name}}"
                                                                                   title="{{$room->translate()->name}}"
                                                                                   class="wp-gallery glry-absolute fancybox thumb">
                                                                                    <div class="overlay">
                                                                                    </div>
                                                                                </a>
                                                                            </div>

                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <div class="slider-nav ">
                                                                    @php($images = json_decode($room->images, true))
                                                                    @foreach($images as $j => $img)
                                                                        <div class="item">
                                                                            <img src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                                                                                 alt="{{$room->translate()->name}}"
                                                                                 title="{{$room->translate()->name}}">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="map-block">
                    <div class="map-info">
                        <h3 class="title-style-2">@lang('hotels.single.contact_us')</h3>
                        <p class="address"><i class="fa fa-map-marker"></i>
                            {{$hotel->addres}}
                        </p>
                        <p class="phone"><i class="fa fa-phone"></i>
                            {{$hotel->phone}}
                        </p>
                        <p class="mail">
                            <a href="mailto:domain@expooler.com"> <i
                                        class="fa fa-envelope-o"></i>
                                {{$hotel->mail}}
                            </a>
                        </p>
                        <div class="footer-block"><a class="btn btn-open-map">@lang('hotels.single.open_map')</a></div>
                    </div>
                    <div id="googleMap"></div>
                </div>
                <div class="container">
                    @include('hotels.similar_hotel')
                </div>
            </div>
        </section>
        {{--@include('includes.similarTours')--}}
    </div>
    <!-- BUTTON BACK TO TOP-->
    <div id="back-top"><a href="#top" class="link"><i class="fa fa-angle-double-up"></i></a></div>
    @include('includes.customer_conditions')
@endsection
@section('script')

    <script>
                @forelse($hotel->getCoordinates() as $point)
        var center = {lat: {{ $point['lat'] }}, lng: {{ $point['lng'] }}};
                @empty
        var center = {
                lat: {{ config('voyager.googlemaps.center.lat') }},
                lng: {{ config('voyager.googlemaps.center.lng') }}};
                @endforelse
        var latitude = parseFloat({{$hotel->latitude}});
        var longitude = parseFloat({{$hotel->longitude}});
        var email = "{{$hotel->email}}";
        var phone = "{{$hotel->phone}}";
        var address = "{{$hotel->addres}}";
        var icon = "{{asset('storage/'.$hotel->image)}}";
        var total_url = "{{route('get_hotel_book_total',['slug' => $hotel->slug])}}";
    </script>
    @parent
    <script>
        $(document).ready(function () {
            $('.room-collapse').collapse();
        });
    </script>
@endsection