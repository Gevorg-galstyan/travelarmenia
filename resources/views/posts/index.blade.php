@extends('layouts.app')
@section('meta')
    <title>{{$coverImage->seo_title}}</title>
    <meta name="description" content="{{$coverImage->meta_description}}">
    <meta name="keywords" content="{{$coverImage->meta_keywords}}">
@endsection
@section('link')
    @parent
    <link type="text/css" rel="stylesheet" href="{{asset('css/insta.css')}}">
@endsection
@section('content')
    <div class="main-content">
        <section class="page-banner blog"
                 style="background-image: url({{asset('storage/'.($coverImage->image ?? 'cover.jpg'))}})">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li class="active"><a href="#" class="link">@lang('header.blog')</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">@lang('header.blog')</h2></div>
                </div>
            </div>
        </section>

        <section class="page-main padding-top padding-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 main-left blog-wrapper">
                        @foreach($posts as $post)
                            <div class="blog-post">
                                <div class="blog-image">
                                    <a href="{{route('blog_detail',['slug' => $post->slug])}}" class="link">
                                        <img src="{{asset(Voyager::image($post->thumbnail('tumb')))}}"
                                             alt="{{$post->translate()->title}}"
                                             title="{{$post->translate()->title}}"
                                             class="img-responsive" width="100%">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <div class="col-xs-2">
                                        <div class="row">
                                            <div class="date">
                                                @php
                                                    $date = explode(' ', $post->created_at);
                                                    $date = explode('-', $date[0]);
                                                    \Carbon\Carbon::setLocale(config('app.locale'));
                                                    $monthName = \Carbon\Carbon::parse($post->created_at)->format('F');
                                                @endphp
                                                <h1 class="day">{{$date[2]}}</h1>
                                                <div class="month">{{strtoupper($monthName)}}</div>
                                                <div class="year">{{$date[0]}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-10 content-wrapper">
                                        <a href="{{route('blog_detail',['slug' => $post->slug])}}" class="heading">
                                            {{$post->translate()->title}}
                                        </a>

                                        {!! $post->translate()->excerpt !!}
                                        <a href="{{route('blog_detail',['slug' => $post->slug])}}"
                                           class="btn btn-gray btn-fit btn-capitalize">
                                            @lang('blog.read_more')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <nav class="pagination-list margin-top70">
                            {{$posts->links()}}
                        </nav>
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
@endsection