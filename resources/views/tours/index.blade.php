@extends('layouts.app')

@section('meta')
    <title>{{$coverImage->seo_title}}</title>
    <meta name="description" content="{{$coverImage->meta_description}}">
    <meta name="keywords" content="{{$coverImage->meta_keywords}}">
@endsection
@section('content')
    <div class="main-content">
        <section class="page-banner tour-result"
                 style="background-image: url({{asset('storage/'.($coverImage->image ?? 'cover.jpg'))}})">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li class="active"><a href="#" class="link">
                                    @lang('header.tours')
                                    {{$countries->where('slug',$link)->first()->translate()->name}}
                                </a>
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">
                            {{__('tours.in.'.$countries->where('slug',$link)->first()->id)}}
                        </h2>
                    </div>
                </div>
            </div>
        </section>
        <div class="page-main">
            <div class="clearfix"></div>
            <div class="tour-result-main padding-top padding-bottom">
                <div class="container car-scrol">
                    <div class="list-continents">
                        @foreach($countries as $i => $country)
                            <div class="list-continent-wrapper">
                                <a href="{{route('tours',['country' => $country->slug])}}"
                                   class="continent {{isset($link) && $link &&
                                   $link == $country->slug ? 'continent-active' : ''}}">
                                    <i class="icons fa fa-map-marker"></i>
                                    <span class="text">
                                        {{$country->translate(session('locale'))->name}}
                                    </span>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    <div class="result-meta">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="result-count-wrapper">@lang('tours.results_found'): <span
                                            class="result-count">
                                        {{$tours->total()}}
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="result-filter-wrapper">
                                    <form>
                                        <label class="result-filter-label">@lang('tours.i_g')</label>
                                        <div class="selection-bar">
                                            <div class="select-wrapper">
                                                <select name="individual_groups"
                                                        class="custom-select form-control individual_groups">
                                                    <option value="individual"
                                                    {{isset($i_g) && $i_g == 'individual' ? 'selected' : ''}}>
                                                        @lang('tours.individual')
                                                    </option>
                                                    <option value="groups"
                                                            {{isset($i_g) && $i_g == 'groups' ? 'selected' : ''}}>
                                                        @lang('tours.groups')
                                                    </option>
                                                </select>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="result-body">
                        <div class="row">
                            <div class="col-md-8 main-right">
                                <div class="tour-container">
                                    <div class="tours-list">
                                        @include('tours.tour_list')
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4 sidebar-widget">
                                <div class="col-2">
                                    <div class="find-widget find-flight-widget widget">
                                        <h4 class="title-widgets">@lang('tours.find')</h4>
                                        <div class="tab-pane">
                                            <form action="" method="get" class="content-widget">
                                                <div class="ffw-radio-selection">
                                                    <div class="ffw-radio-selection">
                                                        <span
                                                                class="ffw-radio-btn-wrapper">
                                                            <input type="radio"
                                                                   name="i_g"
                                                                   value="individual"
                                                                   id="ind_group-1"
                                                                   checked="checked"
                                                                   class="ffw-radio-btn"
                                                                    {{isset($i_g) && $i_g == 'individual' ? 'checked' : ''}}>
                                                            <label for="ind_group-1" class="ffw-radio-label">
                                                                @lang('tours.individual')
                                                            </label>
                                                        </span>
                                                        <span class="ffw-radio-btn-wrapper">
                                                            <input type="radio"
                                                                   name="i_g"
                                                                   value="groups"
                                                                   id="ind_group-2"
                                                                   class="ffw-radio-btn"
                                                                    {{isset($i_g) && $i_g == 'groups' ? 'checked' : ''}}>
                                                            <label for="ind_group-2"
                                                                   class="ffw-radio-label">
                                                                @lang('tours.groups')
                                                            </label>
                                                        </span>
                                                        <div class="stretch">&nbsp</div>
                                                    </div>
                                                </div>
                                                <div class="text-input small-margin-top">
                                                    <div class="text-box-wrapper half left top-padding1">
                                                        <label class="tb-label"> @lang('tours.country') </label>
                                                        <div class="select-wrapper">
                                                            <!--i.fa.fa-chevron-down-->
                                                            <select name="country"
                                                                    class="form-control custom-select">
                                                                <option value=""> --- @lang('tours.select_country') ---</option>
                                                                @foreach($countries as $i => $country)
                                                                    <option value="{{$country->slug}}">
                                                                        {{$country->translate()->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="text-box-wrapper half right">
                                                        <label class="tb-label"> @lang('tours.type') </label>

                                                        <div class="select-wrapper">
                                                            <!--i.fa.fa-chevron-down-->
                                                            <select name="type" class="form-control custom-select">
                                                                <option value=""> --- @lang('tours.select_type') ---</option>
                                                                @foreach($catTypes as $catType)
                                                                    <option value="{{$catType->link}}"
                                                                            {{$type == $catType->link ? 'selected' : ''}}>
                                                                        {{$catType->translate(session('locale'))->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="input-daterange">
                                                        <div class="text-box-wrapper half left"><label
                                                                    class="tb-label">@lang('tours.check_in')</label>
                                                            <div class="input-group">
                                                                <input type="text" name="check_in" placeholder="@lang('tours.date_format')"
                                                                       class="tb-input">
                                                                <i class="tb-icon fa fa-calendar input-group-addon"></i>
                                                            </div>
                                                        </div>
                                                        <div class="text-box-wrapper half right">
                                                            <label class="tb-label">@lang('tours.check_out')</label>
                                                            <div class="input-group">
                                                                <input type="text" name="check_out"
                                                                       placeholder="@lang('tours.date_format')"
                                                                       class="tb-input">
                                                                <i class="tb-icon fa fa-calendar input-group-addon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-box-wrapper half left">
                                                        <label class="tb-label">
                                                            @lang('tours.number_of_adult')
                                                        </label>
                                                        <div class="input-group">
                                                            <button disabled="disabled" data-type="minus"
                                                                    data-field="quant[1]"
                                                                    class="input-group-btn btn-minus">
                                                                <span class="tb-icon fa fa-minus"></span>
                                                            </button>
                                                            <input type="number" name="quant[1]" min="1" max="9"
                                                                   value="1" class="tb-input count">
                                                            <button data-type="plus" data-field="quant[1]"
                                                                    class="input-group-btn btn-plus">
                                                                <span class="tb-icon fa fa-plus"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="text-box-wrapper half right">
                                                        <label class="tb-label">@lang('tours.number_of_child')</label>
                                                        <div class="input-group">
                                                            <button disabled="disabled" data-type="minus"
                                                                    data-field="quant[2]"
                                                                    class="input-group-btn btn-minus">
                                                                <span class="tb-icon fa fa-minus"></span>
                                                            </button>
                                                            <input type="number" name="quant[2]" min="0" max="9"
                                                                   value="0" class="tb-input count">
                                                            <button data-type="plus" data-field="quant[2]"
                                                                    class="input-group-btn btn-plus">
                                                                <span class="tb-icon fa fa-plus"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" data-hover="@lang('tours.send_now')"
                                                        class="btn btn-slide small-margin-top">
                                                    <span class="text">@lang('tours.search_now')</span>
                                                    <span class="icons fa fa-long-arrow-right"></span>
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-2">
                                    {{--<div class="col-1">--}}
                                    {{--@include('includes.price_range')--}}
                                    {{--</div>--}}
                                    <div class="col-1">
                                        <div class="turkey-cities-widget widget">
                                            <div class="title-widget">
                                                <div class="title">@lang('tours.types')</div>
                                            </div>
                                            <div class="content-widget">
                                                <form class="radio-selection">
                                                    @foreach($catTypes as $catType)
                                                        <div class="radio-btn-wrapper">
                                                            <input type="radio"
                                                                   name="type"
                                                                   value="{{$catType->id}}"
                                                                   id="{{$catType->id}}"
                                                                   {{$type == $catType->id ? 'checked' : ''}}
                                                                   class="radio-btn tour-filter">
                                                            <label for="{{$catType->id}}" class="radio-label">
                                                                <span>
                                                                    {!! $catType->icon !!}
                                                                </span>
                                                                {{' '.$catType->translate()->name}}
                                                            </label>
                                                            <span class="count">
                                                                {{$catType->tours->where('country_id', $country_id)->count()}}
                                                            </span>
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
    </div>
    <div id="back-top"><a href="#top" class="link"><i class="fa fa-angle-double-up"></i></a></div>


@endsection
@section('script')
    <script>
        var i_g = "{{isset($i_g) && $i_g == 'groups' ? 'groups' : ''}}";
        var filter_url = "{{route('tours',['country' => $link])}}";

    </script>
    @parent

    <script src="{{asset('assets/libs/plus-minus-input/plus-minus-input.js')}}"></script>
    <script src="{{asset('assets/libs/mouse-direction-aware/jquery.directional-hover.js')}}"></script>
    <script src="{{asset('assets/js/pages/tour-result.js')}}"></script>
    <script src="{{asset('')}}"></script>
    @if(session('comment'))
        <script>
            $('html, body').animate({
                scrollTop: $(".comments-title").offset().top - $('.header-main').height()
            });
        </script>
    @endif
    @if(isset($scrol) && $scrol)
        <script>
            $('html, body').animate({
                scrollTop: $(".car-scrol").offset().top - $('.header-main').height()
            });
        </script>
    @endif
@endsection
