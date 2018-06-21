@extends('layouts.app')
@section('meta')
    <title>{{$blog->seo_title}}</title>
    <meta name="description" content="{{$blog->meta_description}}">
    <meta name="keywords" content="{{$blog->meta_keywords}}">
@endsection

@section('link')
    @parent
    <link type="text/css" rel="stylesheet" href="{{asset('css/insta.css')}}">
@endsection

@section('content')
    <section class="page-banner blog-detail"
             style="background-image: url({{asset('storage/'.($coverImage->image ?? 'cover.jpg'))}})">
        <div class="container">
            <div class="page-title-wrapper">
                <div class="page-title-content">
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                        <li><a href="{{route('blog')}}" class="link home">@lang('header.blog')</a></li>
                        <li class="active"><a href="#" class="link">{{$blog->translate()->title}}</a></li>
                    </ol>
                    <div class="clearfix"></div>
                    <h2 class="captions">{{$blog->translate()->title}}</h2>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <section class="page-main padding-top padding-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 main-left">
                        <div class="item-blog-detail">
                            <div class="blog-post blog-text">
                                <div class="blog-image">
                                    <a href="javascript:void(0)" class="link"><img
                                                src="{{asset('storage/'.$blog->image)}}"
                                                alt="{{$blog->translate()->title}}"
                                                class="img-responsive">
                                    </a>
                                </div>
                                <div class="blog-content margin-bottom70">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <div class="date">
                                                @php
                                                    $date = explode(' ', $blog->created_at);
                                                    $date = explode('-', $date[0]);
                                                    \Carbon\Carbon::setLocale(config('app.locale'));
                                                    $monthName = \Carbon\Carbon::parse($blog->created_at)->format('F');
                                                @endphp
                                                <h1 class="day">{{$date[2]}}</h1>
                                                <div class="month">{{strtoupper($monthName)}}</div>
                                                <div class="year">{{$date[0]}}</div>
                                            </div>
                                        </div>
                                        <div class="col-xs-10 blog-text">
                                            <a href="javascript:void(0)" class="heading">
                                                {{$blog->title}}
                                            </a>
                                            <div class="blog-descritption">
                                                {!! $blog->translate()->body !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-detail-tag tags-widget margin-bottom">
                                    @if(count($blog->heightags) > 0)
                                            @include('posts.tags',['tags' => $blog->heightags, 'simple' => 1])
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 sidebar-widget">
                        <div class="col-2">
                            <div class="search-widget widget">
                                <form>
                                    <div class="input-group search-wrapper">
                                        <input type="text" placeholder="Search..." class="search-input form-control">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn submit-btn">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="col-1">
                                @include('posts.recomendit', ['recomendit_posts' => $recomendit_posts])
                            </div>
                            <div class="col-1">
                                @include('posts.categories',['categories' => $categories])
                                <div class="tags-widget widget">
                                    @include('posts.tags',['tags' => $tags])
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            @include('posts.datedpicker')
                            <div class="col-1">
                                <div class="gallery-widget widget">
                                    <div class="title-widget">
                                        <div class="title">@lang('blog.from_gallery')</div>
                                    </div>
                                    <!-- insta -->


                                    <div class="content-widget">
                                        <div class="insta">
                                            <div id="instafeed"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="social-widget widget wgt">
                                    <div class="title-widget">
                                        <div class="title">@lang('blog.social')</div>
                                    </div>
                                    <div class="content-widget">
                                        <ul class="list-unstyled list-inline">
                                            @foreach($social_links as $link)
                                                <li>
                                                    <a href="{{$link->id == 4 ? 'mailto:'.$link->link : $link->link}}"
                                                       class="social-icon {{$link->icon}}"
                                                       title="{{$link->translate()->name}}"></a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    @parent
    <script src="{{asset('js/insta.js')}}"></script>
    <script src="{{asset('assets/js/pages/blog.js')}}"></script>
    {!! app('captcha')->renderJs(session('locale')) !!}
@endsection

