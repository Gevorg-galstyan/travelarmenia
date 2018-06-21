@extends('layouts.app')
@section('meta')
    @if($coverImage->seo_title)
        <title>{{$coverImage->seo_title}}</title>
        <meta name="description" content="{{$coverImage->meta_description}}">
        <meta name="keywords" content="{{$coverImage->meta_keywords}}">
    @else
        @parent
    @endif
@endsection
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <section class="page-banner bg-faq"
                 style="background-image: url({{asset('storage/'.($coverImage->image ?? 'cover.jpg'))}})">
            <div class="container">
                <div class="page-title-wrapper">
                    <div class="page-title-content">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}" class="link home">@lang('header.home')</a></li>
                            <li class="active"><a href="#" class="link home">@lang('header.faq')</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">@lang('header.faq')</h2></div>
                </div>
            </div>
        </section>
        <div class="page-main">
            <div class="section-faq padding-top padding-bottom">
                <div class="container">
                    <div class="wrapper-faq">
                        <div class="row">
                            <div class="col-md-8 col-sm-12 col-xs-12 main-right">
                                <div class="wrapper-content-faq">
                                    <div class="content-faq padding-bottom">
                                        <h3 class="title-style-2">@lang('faq.faq')</h3>
                                        <div id="accordion-1" class="panel-group wrapper-accordion">
                                            @foreach($questions as $i => $question)
                                                <div class="panel">
                                                    <div class="panel-heading">
                                                        <h5 class="panel-title">
                                                            <a data-toggle="collapse"
                                                               data-parent="#accordion-1"
                                                               href="#collapse-{{$i}}" aria-expanded="false"
                                                               class="accordion-toggle collapsed">
                                                                {!! $question->translate()->question !!}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div id="collapse-{{$i}}" role="tabpanel" aria-expanded="false"
                                                         style="height: 0px"
                                                         class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            {!! $question->translate()->answer !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 wrapper-contact-faq">
                                <div class="contact-wrapper">
                                    <div class="contact-box">
                                        @if(session('alert'))
                                            <div class="alert alert-{{session('alert')}} alert-dismissable fade in">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                {{session('message')}}
                                            </div>
                                        @endif
                                        <h5 class="title">@lang('faq.send_your_question')</h5>
                                        <form class="contact-form" method="post" action="{{route('faq')}}">
                                            {{csrf_field()}}
                                            <input type="text" placeholder="@lang('faq.your_name')" name="name"
                                                   class="form-control form-input
                                                    {{ $errors->has('name') ? ' has-error' : '' }}"
                                                   value="{{old('name')}}"
                                                   required>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong class="error">{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        <!--label.control-label.form-label.warning-label(for="") Warning for the above !-->
                                            <input type="email" placeholder="@lang('faq.your_email')"
                                                   name="email"
                                                   class="form-control form-input
                                                    {{ $errors->has('email') ? ' has-error' : '' }}"
                                                   value="{{old('email')}}"
                                                   required>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong class="error">{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        <!--label.control-label.form-label.warning-label(for="") Warning for the above !-->
                                            <textarea placeholder="@lang('faq.your_question')"
                                                      name="question"
                                                      class="form-control form-input
                                                        {{ $errors->has('question') ? ' has-error' : '' }}"
                                                      required>{{old('name')}}</textarea>
                                            @if ($errors->has('question'))
                                                <span class="help-block">
                                                    <strong class="error">{{ $errors->first('question') }}</strong>
                                                </span>
                                            @endif
                                            <div class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

                                                {!! app('captcha')->display() !!}
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="help-block">
                                                <strong class="error">
                                                    {{ $errors->first('g-recaptcha-response') }}
                                                </strong>
                                            </span>
                                                @endif
                                                @if(session('captcha_errors'))
                                                    <span class="help-block">
                                                <strong class="error"> {{ session('captcha_errors')}}</strong>
                                            </span>
                                                @endif
                                            </div>
                                            <div class="contact-submit">
                                                <button type="submit" data-hover="@lang('faq.send_now')" class="btn btn-slide">
                                                    <span class="text">@lang('faq.send_question')</span>
                                                    <span class="icons fa fa-long-arrow-right"></span>
                                                </button>
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
    <!-- BUTTON BACK TO TOP-->
    <div id="back-top"><a href="#top" class="link"><i class="fa fa-angle-double-up"></i></a></div>
@endsection
@section('script')
    @parent
    {!! app('captcha')->renderJs(session('locale')) !!}
@endsection