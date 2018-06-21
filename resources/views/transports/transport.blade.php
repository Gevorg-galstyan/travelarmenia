@extends('layouts.app')

@section('meta')
    <title>{{$car->seo_title}}</title>
    <meta name="description" content="{{$car->meta_description}}">
    <meta name="keywords" content="{{$car->meta_keywords}}">
@endsection


@section('content')
    <div class="main-content">
        <section class="page-banner car-detail"
                 style="background-image: url({{asset('storage/'.$car->image)}});">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li class="active"><a href="#" class="link">@lang('header.transports')</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">@lang('header.transports')</h2>
                    </div>
                </div>
            </div>
        </section>
        <div class="page-main">
            <div class="clearfix"></div>
            <div class="car-detail-main padding-top padding-bottom">
                <div class="container">
                    <div class="wrapper-car-detail">
                        <div class="content-result">
                            <div class="row">
                                @php($images = json_decode($car->images, true))
                                @if(!empty($images))
                                    <div class="warpper-slider-detail">
                                        <div class="wrapper-cd-detail">
                                            @foreach($images as $img)
                                                <div class="hovereffect">
                                                    <img class="img-responsive"
                                                         src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                                                         alt="{{$car->translate()->name}}"
                                                         title="{{$car->translate()->name}}"
                                                         width="100%">
                                                    <a href="{{Voyager::image($img)}}"
                                                       data-fancybox-group="gallery-hotel"
                                                       title="{{$car->translate()->name}}"
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
                                                         alt="{{$car->translate()->name}}"
                                                         title="{{$car->translate()->name}}"
                                                         class="img-responsive img"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="car-rent-layout">
                                    <div class="content-wrapper">
                                        <a href="#" class="title">
                                            {!! $car->model->icon !!}   {{$car->translate()->name}}
                                        </a>
                                        @if($car->price)
                                            <div class="price">
                                                <p class="for-price">@lang('transport.single.per_day')</p>
                                                <span class="number price" data-name="price">
                                                        <input type="hidden" data-name="origin_price"
                                                               value="{{$car->price}}">
                                                    <span>
                                                        {{round($car->price / (session('valuta_val')
                                                        ? session('valuta_val') : 1))}}
                                                    </span>

                                                    <sup class="unit valuta_sinvol">
                                                        {!! session('valuta_sinvol') !!}
                                                    </sup>
                                                </span>
                                            </div>
                                        @endif
                                        <p class="text">
                                            {!! $car->translate()->description !!}
                                        </p>
                                        <div class="wrapper-car-result">
                                            <div class="wrapper-img-caption">
                                                <div class="col-sm-6">
                                                    <ul class="car-wigdet list-inline list-unstyled">
                                                        <li class="wrapper-car-item">
                                                            <a href="#0" class="car-item">
                                                                @lang('transport.single.type') :
                                                                <span>
                                                                    {{$car->type->translate()->name}}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        @if($car->transmission)
                                                            <li class="wrapper-car-item">
                                                                <a href="#0" class="car-item">
                                                                    @lang('transport.single.transmission') :
                                                                    <span>
                                                                    {{__('transport.single.'.$car->transmission)}}
                                                                </span>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li class="wrapper-car-item">
                                                            <a href="#0" class="car-item">
                                                                @lang('transport.single.seats') :
                                                                <span>
                                                                    {{$car->person_count}}
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="wrapper-car-item">
                                                            <a href="#0" class="car-item">
                                                                @lang('transport.single.luggage_boot') :
                                                                <span>
                                                                    {{$car->trunk}}
                                                                    @lang('transport.single.l')
                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="wrapper-car-item">
                                                            <a href="#0" class="car-item">
                                                                @lang('transport.single.doors') :
                                                                <span>
                                                                    {{$car->door}}
                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li class="wrapper-car-item">
                                                            <a href="#0" class="car-item">
                                                                @lang('transport.single.motor') :
                                                                <span>
                                                                    {{$car->motor}}
                                                                    @lang('transport.single.l')
                                                            </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>@lang('transport.single.period')</th>
                                                            <th>@lang('transport.single.1_day_price')</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($car->pricing as $price)
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
                                        @lang('book_form.book now')
                                    </a>
                                </div>

                                <div class="timeline-book-block book-tour {{session('error') ? 'show-book-block' : ''}}">
                                    <div class="col-sm-12 text-center">
                                        <div class="col-md-2 col-md-offset-8">
                                            @include('includes.change_currency')
                                        </div>
                                    </div>
                                    <div class="find-widget find-hotel-widget widget new-style">
                                        <h4 class="title-widgets">@lang('book_form.special_offer')</h4>

                                        <form class="content-widget transport-book"
                                              action="{{route('get_transport_book',['slug' => $car->slug])}}"
                                              method="post">
                                            {{csrf_field()}}


                                            <div class="col-sm-12">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <table class="table table-bordered table-hover z_index_9">

                                                        <tbody>

                                                        <tr>
                                                            <td class="warning">
                                                                @lang('book_form.Date')
                                                            </td>
                                                            <td class="warning">
                                                                <div class="input-daterange" style="width: 100%">
                                                                    <div class="text-box-wrapper half">
                                                                        <label class="tb-label">
                                                                            @lang('book_form.Check in')
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="text" name="check_in"
                                                                                   placeholder="@lang('book_form.YY/MM/DD')"
                                                                                   class="tb-input send_total"
                                                                                   value="">
                                                                            <i class="tb-icon fa fa-calendar input-group-addon"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-box-wrapper half">
                                                                        <label class="tb-label">
                                                                            @lang('book_form.Check out')
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="text" name="check_out"
                                                                                   placeholder="@lang('book_form.YY/MM/DD')"
                                                                                   class="tb-input send_total"
                                                                                   value="">
                                                                            <i class="tb-icon fa fa-calendar input-group-addon"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @foreach($attributes as $attribute)
                                                            <tr>
                                                                <td class="warning">
                                                                    {{$attribute->translate()->name}}
                                                                </td>
                                                                <td class="warning">

                                                                    <div class="checkbox pull-left">
                                                                        <label>
                                                                            <input type="checkbox"
                                                                                   name="attribute[]"
                                                                                   value="{{$attribute->id}}"
                                                                                   class="car_attribute">
                                                                            <span class="number price"
                                                                                  data-name="price">
                                                                                    <input type="hidden"
                                                                                           data-name="origin_price"
                                                                                           value="{{$attribute->price}}">
                                                                                <span>
                                                                                {{round($attribute->price / (session('valuta_val')
                                                                                    ? session('valuta_val') : 1))}}
                                                                                </span>

                                                                                <sup class="unit valuta_sinvol">
                                                                                    {!! session('valuta_sinvol') !!}
                                                                                </sup>
                                                                            </span>
                                                                        </label>
                                                                    </div>


                                                                </td>
                                                            </tr>

                                                        @endforeach
                                                        <tr>
                                                            <td class="active">
                                                                @lang('book_form.Total')
                                                            </td>
                                                            <td class="active">
                                                                <span class="number price transport-total"
                                                                      data-name="price">
                                                                        <input type="hidden" data-name="origin_price"
                                                                               value="{{$car->price}}">
                                                                    <span>
                                                                        {{round($car->price / (session('valuta_val')
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
                                                        @lang('book_form.Your First Name')
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" name="first_name"
                                                               placeholder="@lang('book_form.Your First Name')"
                                                               class="tb-input">
                                                    </div>
                                                </div>
                                                <div class="last-name text-box-wrapper">
                                                    <label class="tb-label">
                                                        @lang('book_form.Your Last Name')
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" placeholder="@lang('book_form.Your Last Name')"
                                                               name="last_name"
                                                               class="tb-input">
                                                    </div>
                                                </div>
                                                <div class="email text-box-wrapper">
                                                    <label class="tb-label">
                                                        @lang('book_form.Your Email')
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="email" placeholder="@lang('book_form.Your Email')"
                                                               name="email"
                                                               class="tb-input">
                                                    </div>
                                                </div>
                                                <div class="phone text-box-wrapper">
                                                    <label class="tb-label">
                                                        @lang('book_form.Your Number Phone')
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="text" placeholder="@lang('book_form.Your Number Phone')"
                                                               name="phone"
                                                               class="tb-input">
                                                    </div>
                                                </div>
                                                <div class="note text-box-wrapper">
                                                    <label class="tb-label">@lang('book_form.Note'):</label>

                                                    <div class="input-group">
                                                        <textarea placeholder="@lang('book_form.Write your note')"
                                                                  rows="3" name="note"
                                                                  class="tb-input"></textarea>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="checkbox pull-right">
                                                <label>
                                                    <input type="checkbox" name="conditions" class="btn-lg" required>
                                                    @lang('book_form.Yes, I agree with the terms') *
                                                </label>
                                                <div class="">
                                                    <div class="" id="conditions"></div>
                                                </div>
                                                <button type="button" data-toggle="modal"
                                                        data-target="#customer_conditions" href="" class="btn">
                                                    @lang('book_form.Conditions')
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

                                                <button type="submit" data-hover="@lang('book_form.SEND REQUEST')"
                                                        class="btn btn-slide"><span
                                                            class="text">@lang('book_form.BOOK NOW')</span><span
                                                            class="icons fa fa-long-arrow-right"></span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @if(count($similarCars) > 0 )
                                    <div class="special-offer margin-top70">
                                        <h3 class="title-style-2">special offer</h3>
                                        <div class="special-offer-list">
                                            @foreach($similarCars as $similarCar)
                                                <div class="special-offer-layout">
                                                    <div class="image-wrapper">
                                                        <a href="{{route('transport', ['slug' => $similarCar->slug])}}"
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
            </div>
        </div>
    </div>
    @include('includes.customer_conditions')
@endsection
@section('script')
    @parent
    {!! app('captcha')->renderJs(session('locale')) !!}
    <script type="text/javascript" src="{{asset('js/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/car.js')}}"></script>
    <script>
        var local = "{{session('locale')}}";
        var url = "{{route('get_transport_book_total',['slug' => $car->slug])}}";
    </script>

@endsection