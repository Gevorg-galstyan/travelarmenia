@extends('layouts.app')
@section('meta')
    <title>{{$coverImage->seo_title}}</title>
    <meta name="description" content="{{$coverImage->meta_description}}">
    <meta name="keywords" content="{{$coverImage->meta_keywords}}">
@endsection
@section('content')
    <div class="main-content">
        <section class="page-banner tour-view"
                 style="background-image: url({{asset('storage/'.($coverImage->image ?? 'cover.jpg'))}})">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li class="active">
                                <a href="#" class="link home">
                                    @lang('header.review')
                                </a>
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">
                            @lang('header.review')
                        </h2>
                    </div>
                </div>
            </div>
        </section>
        <div class="tour-view-main padding-top padding-bottom">
            <div class="container">
                <div class="item-blog-detail">
                    <div class="blog-post blog-text">
                        <div class="blog-comment">
                            <div class="comment-count blog-comment-title sideline">
                                @lang('header.review')
                            </div>
                            <ul class="comment-list list-unstyled timeline-location-block">
                                @foreach($comments as $i => $comment)
                                   @include('includes.comment')
                                @endforeach
                                <li class="text-center">
                                    {{$comments->links()}}
                                </li>
                            </ul>

                        </div>
                        <div class="leave-comment">
                            <div class="blog-comment-title sideline comments-title">@lang('review.leave_your_comment')</div>
                            @if(session('comment_msg'))
                                <div class="content-wrapper">
                                        <span>
                                            {{session('comment_msg')}}
                                        </span>
                                </div>
                            @endif

                            @include('includes.comment_form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    {!! app('captcha')->renderJs(session('locale')) !!}
    @if(session('alert-type') && session('alert-type') == 'error')
        <script>
            $('html, body').animate({
                scrollTop: $(".comments-title").offset().top - $('.header-main').height()
            });

        </script>
    @endif
@endsection