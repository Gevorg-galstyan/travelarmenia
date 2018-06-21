@extends('layouts.app')
@section('meta')
    <title>{{$coverImage->seo_title}}</title>
    <meta name="description" content="{{$coverImage->meta_description}}">
    <meta name="keywords" content="{{$coverImage->meta_keywords}}">
@endsection
@section('content')
    <div class="main-content">
        <section class="page-banner hotel-result"
                 style="background-image: url({{asset('storage/'.(isset($coverImage->image) ? $coverImage->image : 'cover.jpg'))}})">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li class="active"><a href="#" class="link">@lang('header.home')</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">{{__('header.hotels').' '. __('hotels.in.'.$country->id)}}</h2></div>
                </div>
            </div>
        </section>
        <div class="page-main">
            <div class="clearfix"></div>
            <div class="hotel-result-main padding-top padding-bottom">
                <!-- MAIN CONTENT-->
                <div class="hotel-content">
                    <div class="container car-scrol">
                        <div class="result-meta">
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <div class="result-count-wrapper">@lang('hotels.results_found'): <span
                                                class="result-count">
                                        {{$hotels->total()}}
                                    </span></div>
                                </div>
                            </div>
                        </div>
                        <div class="result-body">
                            <div class="row">
                                <div class="col-md-8 main-right">
                                    <div class="hotel-list">
                                        <div class="row">

                                            @foreach($hotels as $hotel)
                                                <div class="col-sm-12">
                                                    <div class="hotels-layout">
                                                        <div class="image-wrapper">
                                                            <a href="{{route('hotel',['slug' => $hotel->slug])}}"
                                                               class="link">
                                                                <img src="{{asset(Voyager::image($hotel->thumbnail('tumb')))}}"
                                                                     alt="{{$hotel->translate('en')->name}}"
                                                                     class="img-responsive width-100">
                                                            </a>


                                                            @include('hotels.pricing',['echo_sale' => true])

                                                            <div class="title-wrapper">
                                                                <a href="{{route('hotel',['slug' => $hotel->slug])}}"
                                                                   class="title">
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
                                                                        @lang('hotels.book_now')
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <nav class="pagination-list margin-top70">
                                        {{$hotels->links()}}
                                    </nav>
                                </div>
                                <div class="col-md-4 sidebar-widget">
                                    <div class="col-2">
                                        <div class="find-widget find-flight-widget widget">
                                            <h4 class="title-widgets">@lang('hotels.find')</h4>
                                            <div class="tab-pane">
                                                <form action="" method="get" class="content-widget">
                                                    <div class="text-input small-margin-top">
                                                        <div class="text-box-wrapper half left top-padding1">
                                                            <label class="tb-label"> @lang('hotels.country') </label>
                                                            <div class="select-wrapper">
                                                                <!--i.fa.fa-chevron-down-->
                                                                <div class="form-control custom-select">
                                                                    {{$country->translate()->name}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-box-wrapper half right">
                                                            <label class="tb-label"> @lang('hotels.city') </label>
                                                            <div class="select-wrapper">
                                                                <!--i.fa.fa-chevron-down-->
                                                                <select name="city" class="form-control custom-select">
                                                                    <option value=""> --- @lang('hotels.select_city') ---</option>
                                                                    @foreach($country->cities as $city)
                                                                        <option value="{{$city->slug}}"
                                                                                {{$get_city == $city->slug ? 'selected' : ''}}>
                                                                            {{$city->translate(session('locale'))->name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="text-box-wrapper half left">
                                                            <label class="tb-label"> @lang('hotels.type') </label>

                                                            <div class="select-wrapper">
                                                                <!--i.fa.fa-chevron-down-->
                                                                <select name="type" class="form-control custom-select">
                                                                    <option value=""> --- @lang('hotels.select_type') ---</option>
                                                                    <option value="hotel" {{$get_type == 'hotel' ? 'selected' : ''}}>
                                                                        @lang('hotels.hotel')
                                                                    </option>
                                                                    <option value="hostel" {{$get_type == 'hostel' ? 'selected' : ''}}>
                                                                        @lang('hotels.hostel')
                                                                    </option>
                                                                    <option value="resort" {{$get_type == 'resort' ? 'selected' : ''}}>
                                                                        @lang('hotels.resort')
                                                                    </option>
                                                                    <option value="villa" {{$get_type == 'villa' ? 'selected' : ''}}>
                                                                        @lang('hotels.villa')
                                                                    </option>
                                                                    <option value="motel" {{$get_type == 'motel' ? 'selected' : ''}}>
                                                                        @lang('hotels.motel')
                                                                    </option>
                                                                    <option value="bungalow" {{$get_type == 'bungalow' ? 'selected' : ''}}>
                                                                        @lang('hotels.bungalow')
                                                                    </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="text-box-wrapper half right">
                                                            <label class="tb-label">  @lang('hotels.star') </label>

                                                            <div class="select-wrapper">
                                                                <!--i.fa.fa-chevron-down-->
                                                                <select name="star" class="form-control custom-select">
                                                                    <option value=""> --- @lang('hotels.select_star') ---</option>

                                                                    <option value="5"
                                                                            {{$get_star == 5 ? 'selected' : ''}}>
                                                                        5
                                                                    </option>
                                                                    <option value="4"
                                                                            {{$get_star == 4 ? 'selected' : ''}}>
                                                                        4
                                                                    </option>
                                                                    <option value="3"
                                                                            {{$get_star == 3 ? 'selected' : ''}}>
                                                                        3
                                                                    </option>
                                                                    <option value="2"
                                                                            {{$get_star == 2 ? 'selected' : ''}}>
                                                                        2
                                                                    </option>
                                                                    <option value="1"
                                                                            {{$get_star == 1 ? 'selected' : ''}}>
                                                                        1
                                                                    </option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="input-daterange">
                                                            <div class="text-box-wrapper half left"><label
                                                                        class="tb-label">@lang('hotels.check_in')</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="check_in"
                                                                           value="{{$check_in}}"
                                                                           placeholder="@lang('hotels.date_format')"
                                                                           class="tb-input">
                                                                    <i class="tb-icon fa fa-calendar input-group-addon"></i>
                                                                </div>
                                                            </div>
                                                            <div class="text-box-wrapper half right">
                                                                <label class="tb-label">@lang('hotels.check_out')</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="check_out"
                                                                           value="{{$check_out}}"
                                                                           placeholder="@lang('hotels.date_format')"
                                                                           class="tb-input">
                                                                    <i class="tb-icon fa fa-calendar input-group-addon"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" data-hover="@lang('hotels.send_now')"
                                                            class="btn btn-slide small-margin-top">
                                                        <span class="text">@lang('hotels.search_now')</span>
                                                        <span class="icons fa fa-long-arrow-right"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="col-1">
                                            {{--@include('includes.price_range')--}}
                                            <div class="turkey-cities-widget widget">
                                                <div class="title-widget">
                                                    <div class="title">
                                                        @lang('hotels.star_hotels')
                                                    </div>
                                                </div>
                                                <div class="content-widget">
                                                    <form class="radio-selection">
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   name="rating"
                                                                   value="5"
                                                                   id="1stars"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_star == 5 ? 'checked' : ''}}>
                                                            <label for="1stars"
                                                                   class="radio-label stars stars5">
                                                                1stars
                                                            </label>
                                                            @php($star = $country->hotels->where('star', 5)->count())
                                                            <span class="count">{{$star ? $star : 0}}</span>
                                                        </div>
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   name="rating"
                                                                   value="4"
                                                                   id="2stars"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_star == 4 ? 'checked' : ''}}>
                                                            <label for="2stars"
                                                                   class="radio-label stars stars4">
                                                                2stars
                                                            </label>
                                                            @php($star = $country->hotels->where('star', 4)->count())
                                                            <span class="count">{{$star ? $star : 0}}</span>
                                                        </div>
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   name="rating"
                                                                   value="3"
                                                                   id="3stars"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_star == 3 ? 'checked' : ''}}>
                                                            <label for="3stars"
                                                                   class="radio-label stars stars3">
                                                                3stars
                                                            </label>
                                                            @php($star = $country->hotels->where('star', 3)->count())
                                                            <span class="count">{{$star ? $star : 0}}</span>
                                                        </div>
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   name="rating"
                                                                   value="2"
                                                                   id="4stars"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_star == 2 ? 'checked' : ''}}>
                                                            <label
                                                                    for="4stars"
                                                                    class="radio-label stars stars2">
                                                                4stars
                                                            </label>
                                                            @php($star = $country->hotels->where('star', 2)->count())
                                                            <span class="count">{{$star ? $star : 0}}</span>
                                                        </div>
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   name="rating"
                                                                   value="1"
                                                                   id="5stars"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_star == 1 ? 'checked' : ''}}>
                                                            <label for="5stars"
                                                                   class="radio-label stars stars1">
                                                                5stars
                                                            </label>
                                                            @php($star = $country->hotels->where('star', 1)->count())
                                                            <span class="count">{{$star ? $star : 0}}</span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="accommodation-widget widget">
                                                <div class="title-widget">
                                                    <div class="title">@lang('hotels.accommodation')</div>
                                                </div>
                                                <div class="content-widget">
                                                    <form class="radio-selection">

                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   id="hotel"
                                                                   name="accommodation"
                                                                   value="hotel"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_type == 'hotel' ? 'checked' : ''}}>
                                                            <label for="hotel"
                                                                   class="radio-label">
                                                                @lang('hotels.hotel')
                                                            </label>
                                                            <span class="count">
                                                                    {{$country->hotels()->where('type', 'hotel')->count()}}
                                                                </span>
                                                        </div>
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   id="hostel"
                                                                   name="accommodation"
                                                                   value="hostel"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_type == 'hostel' ? 'checked' : ''}}>
                                                            <label for="hostel"
                                                                   class="radio-label">
                                                                @lang('hotels.hostel')
                                                            </label>
                                                            <span class="count">
                                                                    {{$country->hotels()->where('type', 'hostel')->count()}}
                                                                </span>
                                                        </div>
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   id="resort"
                                                                   name="accommodation"
                                                                   value="resort"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_type == 'resort' ? 'checked' : ''}}>
                                                            <label for="resort"
                                                                   class="radio-label">
                                                                @lang('hotels.resort')
                                                            </label>
                                                            <span class="count">
                                                                    {{$country->hotels()->where('type', 'resort')->count()}}
                                                                </span>
                                                        </div>
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   id="villa"
                                                                   name="accommodation"
                                                                   value="villa"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_type == 'villa' ? 'checked' : ''}}>
                                                            <label for="villa"
                                                                   class="radio-label">
                                                                @lang('hotels.villa')
                                                            </label>
                                                            <span class="count">
                                                                    {{$country->hotels()->where('type', 'villa')->count()}}
                                                                </span>
                                                        </div>
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   id="motel"
                                                                   name="accommodation"
                                                                   value="motel"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_type == 'motel' ? 'checked' : ''}}>
                                                            <label for="motel"
                                                                   class="radio-label">
                                                                @lang('hotels.motel')
                                                            </label>
                                                            <span class="count">
                                                                    {{$country->hotels()->where('type', 'motel')->count()}}
                                                                </span>
                                                        </div>
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   id="bungalow"
                                                                   name="accommodation"
                                                                   value="bungalow"
                                                                   class="radio-btn hotel-filter"
                                                                    {{$get_type == 'bungalow' ? 'checked' : ''}}>
                                                            <label for="bungalow"
                                                                   class="radio-label">
                                                                @lang('hotels.bungalow')
                                                            </label>
                                                            <span class="count">
                                                                    {{$country->hotels()->where('type', 'bungalow')->count()}}
                                                                </span>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BUTTON BACK TO TOP-->
    <div id="back-top"><a href="#top" class="link"><i class="fa fa-angle-double-up"></i></a></div>
@endsection

@section('script')
    <script>
        var selector = 'hotel';
        var filter_url = "{{route('hotels',['country' => $country->slug,'city' => $get_city])}}";
    </script>
    @parent
    @if(isset($scrol) && $scrol)
        <script>
            $('html, body').animate({
                scrollTop: $(".car-scrol").offset().top - $('.header-main').height()
            });
        </script>
    @endif
@endsection