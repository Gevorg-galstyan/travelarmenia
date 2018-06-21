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
                            <li class="active"><a href="#" class="link">@lang('header.transports')</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">@lang('header.transports')</h2></div>
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
                                @lang('transport.results_found'): <span class="result-count">{{$cars->total() }}</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="result-body">
                    <div class="row">
                        <div class="col-md-8 main-right">
                            <div class="car-rent-list">
                                <div class="row">
                                    @foreach($cars as $car)
                                        <div class="col-sm-12">
                                            <div class="car-rent-layout">
                                                <div class="image-wrapper">
                                                    <a href="{{route('transport',['slug' => $car->slug])}}"
                                                       class="link">
                                                        <img src="{{asset(Voyager::image($car->thumbnail('tumb')))}}"
                                                             alt=""
                                                             class="img-responsive width-100">
                                                    </a>
                                                </div>
                                                <div class="content-wrapper">
                                                    <a href="#" class="title">
                                                       {!! $car->model->icon !!}  {{ $car->translate()->name }}
                                                    </a>
                                                    @if(isset($car->price))
                                                        <div class="price">
                                                            <span class="number" data-name="price">
                                                                <input type="hidden" data-name="origin_price"
                                                                       value="{{$car->price}}">
                                                                <span>
                                                                    {{round($car->price / (session('valuta_val')
                                                                    ? session('valuta_val') : 1))}}
                                                                </span>
                                                            </span>
                                                            <sup class="valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
                                                        </div>
                                                    @endif
                                                    <div class="sub-title">
                                                        {{$car->type->translate()->name}}
                                                    </div>
                                                    <p class="text">
                                                        {!! $car->translate()->short_description !!}
                                                    </p>
                                                    <a href="{{route('transport',['slug' => $car->slug])}}" x
                                                       class="btn btn-gray">
                                                        @lang('transport.book_now')
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <nav class="pagination-list margin-top70">
                                {{ $cars->links() }}
                            </nav>
                        </div>
                        <div class="col-md-4 sidebar-widget">
                            <div class="col-2">
                                <div class="find-widget find-flight-widget widget">
                                    <h4 class="title-widgets">@lang('transport.find')</h4>
                                    <form class="content-widget" action="{{route('transports')}}" method="get">
                                        <div class="text-input small-margin-top">
                                            <div class="text-box-wrapper">
                                                <label class="tb-label">@lang('transport.model')</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           name="model"
                                                           placeholder="@lang('transport.model')"
                                                           class="tb-input">
                                                </div>
                                            </div>
                                            <div class="text-box-wrapper half left {{ $errors->has('type') ? ' has-error' : '' }}">
                                                <label class="tb-label"> @lang('transport.type') </label>
                                                @if ($errors->has('type'))
                                                    <spam class="error"> {{ $errors->first('type') }}</spam>
                                                @endif
                                                <div class="select-wrapper">
                                                    <!--i.fa.fa-chevron-down-->
                                                    <select name="car_type" class="form-control custom-select child">
                                                        <option value=""> --- @lang('transport.select_type') ---</option>
                                                        @foreach($types as $type)
                                                            <option value="{{$type->id}}"
                                                                    {{isset($car_type) && $car_type == $type->id?'selected':''}}>
                                                                {{$type->translate(
                                                                ($type->translate(session('locale'))->name ? '' : 'ru')
                                                                )->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-box-wrapper half right {{ $errors->has('mark') ? ' has-error' : '' }}">
                                                <label class="tb-label"> @lang('transport.mark') </label>
                                                @if ($errors->has('mark'))
                                                    <spam class="error"> {{ $errors->first('mark') }}</spam>
                                                @endif
                                                <div class="select-wrapper">
                                                    <!--i.fa.fa-chevron-down-->
                                                    <select name="car_mark" class="form-control custom-select child">
                                                        <option value=""> --- @lang('transport.select_mark') ---</option>
                                                        @foreach($marks as $mark)
                                                            <option value="{{$mark->id}}"
                                                                    {{isset($car_mark) && $car_mark == $type->id?'selected':''}}>
                                                                {{$mark->translate(
                                                                ($mark->translate(session('locale'))->name ? '' : 'ru')
                                                                )->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-box-wrapper half left {{ $errors->has('min_price') ? ' has-error' : '' }}">
                                                <label class="tb-label">@lang('transport.min_price')</label>
                                                @if ($errors->has('min_price'))
                                                    <spam class="error"> {{ $errors->first('min_price') }}</spam>
                                                @endif
                                                <div class="input-group">
                                                    <input type="number" name="min_price" min="0"
                                                           value="{{$min_price}}"
                                                           class="tb-input" placeholder="@lang('transport.min_price')">

                                                </div>
                                            </div>
                                            <div class="text-box-wrapper half right {{ $errors->has('max_price') ? ' has-error' : '' }}">
                                                <label class="tb-label">@lang('transport.max_price')</label>
                                                @if ($errors->has('max_price'))
                                                    <spam class="error"> {{ $errors->first('max_price') }}</spam>
                                                @endif
                                                <div class="input-group">
                                                    <input type="number" name="max_price" min="1"
                                                           value="{{$max_price}}"
                                                           class="tb-input" placeholder="@lang('transport.max_price')">

                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" data-hover="@lang('transport.send_now')"
                                                class="btn btn-slide small-margin-top"><span
                                                    class="text">@lang('transport.search_now')</span><span
                                                    class="icons fa fa-long-arrow-right"></span></button>
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
                                            <div class="title">@lang('transport.types')</div>
                                        </div>
                                        <div class="content-widget">
                                            <form class="radio-selection">
                                                @foreach($types as $type)
                                                    <div class="radio-btn-wrapper">
                                                        <input type="radio" name="car_type"
                                                               value="{{$type->id}}" id="type_{{$type->id}}"
                                                               class="radio-btn car-filter"
                                                        {{isset($car_type) && $car_type == $type->id ? 'checked' : ''}}>
                                                        <label for="type_{{$type->id}}" class="radio-label">
                                                           {!! $type->icon !!} {{$type->translate()->name}}
                                                        </label>
                                                        <span class="count">{{$cars->where('car_type_id',$type->id)->count()}}</span>
                                                    </div>
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="special-equipment-widget widget">
                                    <div class="title-widget">
                                        <div class="title">@lang('transport.marks')</div>
                                    </div>
                                    <div class="content-widget">
                                        <form class="radio-selection">
                                            @foreach($marks as $mark)
                                                <div class="radio-btn-wrapper">
                                                    <input type="radio" name="car_mark"
                                                           value="{{$mark->id}}"
                                                           id="mark_{{$mark->id}}"
                                                           class="radio-btn car-filter"
                                                            {{isset($car_mark) && $car_mark == $mark->id ? 'checked' : ''}}>
                                                    <label for="mark_{{$mark->id}}" class="radio-label">
                                                        {!! $mark->icon !!} {{$mark->translate()->name}}
                                                    </label>

                                                    <span class="count">{{$cars->where('car_mark_id',$mark->id)->count()}}</span>
                                                </div>
                                            @endforeach

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
@endsection
@section('script')
    <script>
        var price_min = "{{isset($price_min) ? $price_min : ''}}"
        var price_max = "{{isset($price_max) ? $price_max : ''}}"
        var selector = 'car';
        var filter_url = "{{route('transports')}}";
    </script>
    @parent

    <script src="{{asset('assets/libs/plus-minus-input/plus-minus-input.js')}}"></script>
    <script src="{{asset('assets/libs/mouse-direction-aware/jquery.directional-hover.js')}}"></script>
    <script src="{{asset('assets/js/pages/car-result.js')}}"></script>
    @if(isset($scrol) && $scrol)
        <script>
            $('html, body').animate({
                scrollTop: $(".car-scrol").offset().top - $('.header-main').height()
            });
        </script>
    @endif
@endsection