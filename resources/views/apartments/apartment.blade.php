@extends('layouts.app')

@section('meta')
    <title>{{$apartment->seo_title}}</title>
    <meta name="description" content="{{$apartment->meta_description}}">
    <meta name="keywords" content="{{$apartment->meta_keywords}}">
@endsection


@section('content')
    <div class="main-content">
        <section class="page-banner car-detail"
                 style="background-image: url({{asset('storage/'.$apartment->image)}});">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li><a href="{{route('apartments')}}" class="link">@lang('header.apartments')</a></li>
                            <li class="active"><a href="#" class="link">{{$apartment->translate()->title}}</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">{{$apartment->translate()->title}}</h2>
                    </div>
                </div>
            </div>
        </section>

        <div class="clearfix"></div>
        <div class="car-detail-main padding-top padding-bottom">
            <div class="container">
                <div class="wrapper-car-detail">
                    <div class="content-result">
                        <div class="row">
                            @foreach($apartment->images as $apartment_images)
                                @php($images = json_decode($apartment_images->images, true))
                                @if(!empty($images))
                                    <div class="warpper-slider-detail">
                                        <div class="wrapper-cd-detail">
                                            @foreach($images as $img)
                                                <div class="hovereffect">
                                                    <img class="img-responsive"
                                                         src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                                                         alt="{{$apartment_images->translate()->name}}"
                                                         title="{{$apartment_images->translate()->name}}"
                                                         width="100%">
                                                    <a href="{{Voyager::image($img)}}"
                                                       data-fancybox-group="gallery-hotel"
                                                       title="{{$apartment_images->translate()->name}}"
                                                       class="wp-gallery glry-absolute fancybox thumb">
                                                        <div class="overlay">
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="wrapper-cd-detail-thumnail">
                                            @foreach($images as $img)
                                                <div class="thumnail-item">
                                                    <img src="{{Voyager::image($img)}}"
                                                         alt="{{$apartment_images->translate()->name}}"
                                                         title="{{$apartment_images->translate()->name}}"
                                                         class="img-responsive img"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="car-rent-layout">
                                <div class="content-wrapper">
                                    <a href="#" class="title">
                                        {{$apartment->translate()->title}}
                                    </a>
                                    @if($apartment->price)
                                        <div class="price">
                                            <p class="for-price">@lang('apartment.single.per_day')</p>
                                            <span class="number price" data-name="price">
                                                        <input type="hidden" data-name="origin_price"
                                                               value="{{$apartment->price}}">
                                                    <span>
                                                        {{round($apartment->price / (session('valuta_val')
                                                        ? session('valuta_val') : 1))}}
                                                    </span>

                                                    <sup class="unit valuta_sinvol">
                                                        {!! session('valuta_sinvol') !!}
                                                    </sup>
                                                </span>
                                        </div>
                                    @endif
                                    <p class="text">
                                        {!! $apartment->translate()->description !!}
                                    </p>
                                    <div class="wrapper-car-result">
                                        <div class="wrapper-img-caption">
                                            <div class="col-sm-6">
                                                <ul class="car-wigdet list-inline list-unstyled">
                                                    @foreach($apartment->rooms as $room)
                                                        <li class="wrapper-car-item">
                                                            <a href="#0" class="car-item">
                                                                {{$room->translate()->name}} :
                                                                <span>
                                                                    {{$room->note}}
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                            <div class="col-sm-6">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('apartment.single.period')</th>
                                                        <th>@lang('apartment.single.1_day_price')</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($apartment->pricing as $price)
                                                        <tr>
                                                            <td>{{$price->day}}</td>
                                                            <td>
                                                                    <span class="number price pull-left"
                                                                          data-name="price">
                                                                        <input type="hidden" data-name="origin_price"
                                                                               value="{{$price->price}}">
                                                                    <span>
                                                                        {{round($price->price / (session('valuta_val')
                                                                        ? session('valuta_val') : 1))}}
                                                                    </span>

                                                                    <sup class="unit valuta_sinvol">
                                                                        {!! session('valuta_sinvol') !!}
                                                                    </sup>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper-btn" id="book">
                                <a href="#" class="btn btn-maincolor btn-book-tour book-car">
                                    @lang('apartment.book_now')
                                </a>
                            </div>

                            <div class="timeline-book-block book-tour {{session('error') ? 'show-book-block' : ''}}">
                                <div class="col-sm-12 text-center">
                                    <div class="col-md-2 col-md-offset-8">
                                        @include('includes.change_currency')
                                    </div>
                                </div>
                                <div class="find-widget find-hotel-widget widget new-style">
                                    <h4 class="title-widgets">BOOK ROOM</h4>

                                    <form class="content-widget transport-book"
                                          action="{{route('get_apartment_book',['slug' => $apartment->slug])}}"
                                          method="post">
                                        {{csrf_field()}}


                                        <div class="col-sm-12">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <table class="table table-bordered table-hover z_index_9">

                                                    <tbody>

                                                    <tr>
                                                        <td class="warning">
                                                            Date
                                                        </td>
                                                        <td class="warning">
                                                            <div class="input-daterange" style="width: 100%">
                                                                <div class="text-box-wrapper half">
                                                                    <label class="tb-label">
                                                                        Check in
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="check_in"
                                                                               placeholder="MM/DD/YY"
                                                                               class="tb-input send_total"
                                                                               value="">
                                                                        <i class="tb-icon fa fa-calendar input-group-addon"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="text-box-wrapper half">
                                                                    <label class="tb-label">
                                                                        Check out
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="check_out"
                                                                               placeholder="MM/DD/YY"
                                                                               class="tb-input send_total"
                                                                               value="">
                                                                        <i class="tb-icon fa fa-calendar input-group-addon"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="active">
                                                            Total
                                                        </td>
                                                        <td class="active">
                                                                <span class="number price transport-total"
                                                                      data-name="price">
                                                                        <input type="hidden" data-name="origin_price"
                                                                               value="{{$apartment->price}}">
                                                                    <span>
                                                                        {{round($apartment->price / (session('valuta_val')
                                                                        ? session('valuta_val') : 1))}}
                                                                    </span>

                                                                    <sup class="unit valuta_sinvol">
                                                                        {!! session('valuta_sinvol') !!}
                                                                    </sup>
                                                                </span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="text-input small-margin-top margin-bottom70">

                                            <div class="first-name text-box-wrapper">
                                                <label class="tb-label">
                                                    Your First Name
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="first_name"
                                                           placeholder="Write your first name"
                                                           class="tb-input">
                                                </div>
                                            </div>
                                            <div class="last-name text-box-wrapper">
                                                <label class="tb-label">
                                                    Your Last Name
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" placeholder="Write your last name"
                                                           name="last_name"
                                                           class="tb-input">
                                                </div>
                                            </div>
                                            <div class="email text-box-wrapper">
                                                <label class="tb-label">
                                                    Your Email
                                                </label>
                                                <div class="input-group">
                                                    <input type="email" placeholder="Write your email address"
                                                           name="email"
                                                           class="tb-input">
                                                </div>
                                            </div>
                                            <div class="phone text-box-wrapper">
                                                <label class="tb-label">
                                                    Your Number Phone
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" placeholder="Write your number phone"
                                                           name="phone"
                                                           class="tb-input">
                                                </div>
                                            </div>
                                            <div class="note text-box-wrapper">
                                                <label class="tb-label">Note:</label>

                                                <div class="input-group">
                                                        <textarea placeholder="Write your note"
                                                                  rows="3" name="note"
                                                                  class="tb-input"></textarea>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="checkbox pull-right">
                                            <label>
                                                <input type="checkbox" name="conditions" class="btn-lg" required>
                                                Yes, I agree with the terms *
                                            </label>
                                            <div class="">
                                                <div class="" id="conditions"></div>
                                            </div>
                                            <button type="button" data-toggle="modal"
                                                    data-target="#customer_conditions" href="" class="btn">
                                                Conditions
                                            </button>
                                        </div>
                                        <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                            {!! app('captcha')->display() !!}
                                            @if ($errors->has('g-recaptcha-response'))
                                                <spam class="error pull-left"> {{ $errors->first('g-recaptcha-response') }}</spam>
                                            @endif
                                            @if(isset($captcha_errors))
                                                <spam class="error pull-left"> {{ $captcha_errors }}</spam>
                                            @endif
                                        </div>
                                        <div class="row">

                                            <button type="submit" data-hover="SEND REQUEST"
                                                    class="btn btn-slide"><span
                                                        class="text">BOOK Now</span><span
                                                        class="icons fa fa-long-arrow-right"></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @if($similarApartment->count() > 0 )
                                <div class="special-offer margin-top70">
                                    <h3 class="title-style-2">special offer</h3>
                                    <div class="special-offer-list">
                                        @foreach($similarApartment as $item)
                                            <div class="special-offer-layout">
                                                <div class="image-wrapper">
                                                    <a href="{{route('apartment', ['slug' => $item->slug])}}"
                                                       class="link">
                                                        <img src="{{asset('images/car/'.$similarCar->cover_image)}}"
                                                             alt="" class="{{$similarCar->translate()->name}}">
                                                    </a>
                                                    <div class="title-wrapper">
                                                        <a href="{{route('transport', ['slug' => $similarCar->slug])}}"
                                                           class="title">
                                                            {!! $similarCar->model->icon !!}  {{ $similarCar->translate()->name }}
                                                        </a>
                                                        <i class="icons flaticon-circle"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="map-block">
                <div class="map-info">
                    <h3 class="title-style-2">@lang('apartment.single.contact_us')</h3>
                    <p class="address"><i class="fa fa-map-marker"></i>
                        {{$apartment->address}}
                    </p>
                    <div class="footer-block">
                        <a class="btn btn-open-map">@lang('apartment.single.open_map')</a>
                    </div>
                </div>
                <div id="googleMap"></div>
            </div>


        </div>
    </div>
    @include('includes.customer_conditions')
@endsection
@section('script')
    <script>
                @forelse($apartment->getCoordinates() as $point)
        var center = {lat: {{ $point['lat'] }}, lng: {{ $point['lng'] }}};
                @empty
        var center = {
                lat: {{ config('voyager.googlemaps.center.lat') }},
                lng: {{ config('voyager.googlemaps.center.lng') }}};
                @endforelse
        var latitude = parseFloat({{$apartment->latitude}});
        var longitude = parseFloat({{$apartment->longitude}});
        var email = null;
        var phone = null;
        var address = "{{$apartment->address}}";
        var icon = "{{asset('storage/'.$apartment->image)}}";
    </script>
    @parent
    {!! app('captcha')->renderJs(session('locale')) !!}
    <script type="text/javascript" src="{{asset('js/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/car.js')}}"></script>
    <script>
        var local = "{{session('locale')}}";
        var url = "{{route('get_apartment_book_total',['slug' => $apartment->slug])}}";
    </script>

@endsection