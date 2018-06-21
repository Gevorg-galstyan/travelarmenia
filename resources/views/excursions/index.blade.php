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
                            <li><a href="{{route('home')}}" class="link home">Home</a></li>
                            <li class="active"><a href="#" class="link">Excursion</a></li>
                        </ol>
                        <div class="clearfix"></div>
                        <h2 class="captions">Excursion</h2></div>
                </div>
            </div>
        </section>
        <div class="page-main">
            <div class="clearfix"></div>
            <div class="hotel-result-main padding-top padding-bottom">
                <!-- MAIN CONTENT-->
                <div class="hotel-content">
                    <div class="container car-scrol">
                        <div class="row">
                            @if($excursions)
                                <div class="col-lg-4 col-md-12">
                                    <div class="result-count-wrapper">
                                        Results Found:
                                        <span class="result-count">
                                        {{$excursions->total()}}
                                    </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="result-body">
                            <div class="row">
                                <div class="col-md-12 sidebar-widget">
                                    <div class="col-2">
                                        <div class="find-widget find-flight-widget widget">
                                            <h4 class="title-widgets">find your EXCURSION</h4>
                                            <div class="tab-pane">
                                                <div class="row">
                                                    <div class="col-md-6 col-md-offset-3 search-content">
                                                        <form action="{{route('excursions')}}" method="get">
                                                            <div id="custom-search-input">
                                                                <div class="input-group col-md-12">
                                                                    <input type="text"
                                                                           class="form-control input-lg"
                                                                           name="excursion"
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="col-1">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 main-right">
                                    <div class="hotel-list">
                                        <div class="row">
                                            @if($excursions)
                                                @foreach($excursions as $excursion)
                                                    @include('excursions.single_excursion')
                                                @endforeach
                                            @else
                                                @include('excursions.single_excursion')
                                            @endif
                                        </div>
                                    </div>
                                    @if($excursions)
                                        <nav class="pagination-list margin-top70">
                                            {{$excursions->links()}}
                                        </nav>
                                    @endif
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
    <script src="{{asset('assets/js/pages/excursion.js')}}"></script>
    <script>
        $('input[name="excursion"]').keyup(function () {
            if ($(this).val().length > 2) {
                $('.search-button').html(' <i class="fa fa-spinner fa-spin"></i>');
                $.ajax({
                    url: '{{route('excursions_search')}}',
                    type: 'post',
                    data: {excursions: $(this).val(), _token: '{{csrf_token()}}'},
                    success: function (data) {
                        $('.search-button').html('<i class="fa fa-search"></i>');
                        $('.search-result').remove();
                        $('.search-content').append(data)
                    }
                })
            }
        })
    </script>
@endsection