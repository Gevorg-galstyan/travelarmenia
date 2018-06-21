@extends('layouts.app')
@section('meta')
    <title>{{$coverImage->seo_title}}</title>
    <meta name="description" content="{{$coverImage->meta_description}}">
    <meta name="keywords" content="{{$coverImage->meta_keywords}}">
@endsection
@section('content')

    <div class="main-content">
        <section class="page-banner car-rent-result"
                 style="background-image: url({{asset('storage/'.($coverImage->image ?? 'cover.jpg'))}})">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li class="active"><a href="#" class="link">@lang('header.apartments')</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">@lang('header.apartments')</h2></div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <div class="car-rent-result-main padding-top padding-bottom">
            <div class="container car-scrol">
                <div class="result-meta">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="result-count-wrapper">
                                @lang('header.results_found'): <span class="result-count">{{$apartments->total() }}</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="result-body">
                    <div class="row">
                        <div class="col-md-8 main-right">
                            <div class="car-rent-list">
                                <div class="row">
                                    @foreach($apartments as $apartment)
                                        <div class="col-sm-12">
                                            <div class="car-rent-layout">
                                                <div class="image-wrapper">
                                                    <a href="{{route('apartment',['slug' => $apartment->slug])}}"
                                                       class="link">
                                                        <img src="{{asset(Voyager::image($apartment->thumbnail('tumb')))}}"
                                                             alt=""
                                                             class="img-responsive width-100">
                                                    </a>
                                                </div>
                                                <div class="content-wrapper">
                                                    @if(isset($apartment->price))
                                                        <div class="price">
                                                            <span class="number" data-name="price">
                                                                <input type="hidden" data-name="origin_price"
                                                                       value="{{$apartment->price}}">
                                                                <span>
                                                                    {{round($apartment->price / (session('valuta_val')
                                                                    ? session('valuta_val') : 1))}}
                                                                </span>
                                                            </span>
                                                            <sup class="valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
                                                        </div>
                                                    @endif
                                                    <div class="sub-title">
                                                        {{$apartment->translate()->title}}
                                                    </div>
                                                    <div class="sub-title">
                                                        {{$apartment->translate()->type}}
                                                    </div>
                                                    <p class="text">
                                                        {!! $apartment->translate()->short_description !!}
                                                    </p>
                                                    <a href="{{route('apartment',['slug' => $apartment->slug])}}"
                                                       class="btn btn-gray">
                                                        @lang('apartment.book_now')
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <nav class="pagination-list margin-top70">
                                {{ $apartments->links() }}
                            </nav>
                        </div>
                        <div class="col-md-4 sidebar-widget">
                            <div class="col-2">
                                <div class="find-widget find-flight-widget widget search-content">
                                    <h4 class="title-widgets">@lang('header.search')</h4>
                                    <form action="{{route('apartments')}}" method="get">
                                        <div id="custom-search-input">
                                            <div class="input-group col-md-12">
                                                <input type="text"
                                                       class="form-control input-lg"
                                                       name="apartment"
                                                       placeholder="find your excursion"
                                                       value="{{$search_text}}"/>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info btn-lg search-button"
                                                            type="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="col-1">
                                    @include('includes.price_range')
                                </div>
                                <div class="col-1">
                                    <div class="car-type-widget widget">
                                        <div class="title-widget">
                                            <div class="title">@lang('apartment.apartment_type')</div>
                                        </div>
                                        <div class="content-widget">
                                            <form class="radio-selection">

                                                <div class="radio-btn-wrapper">
                                                    <input type="radio" name="apartment_type"
                                                           value="apartment" id="apartment"
                                                           class="radio-btn car-filter"
                                                           data-href="{{route('apartments',['type' => 'apartment'])}}"
                                                            {{isset($type) && $type == 'apartment' ? 'checked' : ''}}>
                                                    <label for="apartment" class="radio-label">
                                                        @lang('apartment.apartment')
                                                    </label>
                                                    <span class="count">{{$apartment_count}}</span>
                                                </div>
                                                <div class="radio-btn-wrapper">
                                                    <input type="radio" name="apartment_type"
                                                           value="house" id="house"
                                                           class="radio-btn car-filter"
                                                           data-href="{{route('apartments',['type' => 'house'])}}"
                                                            {{isset($type) && $type == 'house' ? 'checked' : ''}}>
                                                    <label for="house" class="radio-label">
                                                        @lang('apartment.house')
                                                    </label>
                                                    <span class="count">{{$house_count}}</span>
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
@endsection
@section('script')
    <script>
        var price_min = "{{isset($price_min) ? $price_min : ''}}"
        var price_max = "{{isset($price_max) ? $price_max : ''}}"
        var filter_url = "{{route('apartments')}}";

    </script>
    @parent
    <script>
        @if(isset($scrol) && $scrol)

        $('html, body').animate({
            scrollTop: $(".car-scrol").offset().top - $('.header-main').height()
        });
        @endif
        $('input[name="apartment"]').keyup(function () {
            if ($(this).val().length > 2) {
                $('.search-button').html(' <i class="fa fa-spinner fa-spin"></i>');
                $.ajax({
                    url: '{{route('apartment_search')}}',
                    type: 'post',
                    data: {excursions: $(this).val(), _token: '{{csrf_token()}}'},
                    success: function (data) {
                        $('.search-button').html('<i class="fa fa-search"></i>');
                        $('.search-result').remove();
                        $('.search-content').append(data)
                        console.log(data)
                    }
                })
            }
        })

        $('input[name=apartment_type]').click(function () {
            if ($(this).is(':checked')) {
                location.href = $(this).data('href')
            }
        })
    </script>
@endsection