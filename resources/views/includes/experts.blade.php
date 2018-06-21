<section class="our-expert padding-top padding-bottom-50">
    <div class="container">
        <h3 class="title-style-2">@lang('about.our_expert')</h3>
        <div class="wrapper-expert">
            @foreach($experts as $expert)
                <div class="content-organization">
                    <div class="wrapper-img">
                        <img src="{{asset('storage/'.$expert->image)}}"
                             alt="{{ $expert->translate()->name }}"
                             title="{{ $expert->translate()->name }}"
                             class="img img-responsive">
                    </div>
                    <div class="main-organization">
                        <div class="organization-title">
                            <a href="#" class="title">
                                {{$expert->translate()->name}}
                            </a>
                        </div>
                        <div class="content-widget">
                            <div class="info-list">
                                <ul class="list-unstyled">
                                    <li class="main-list"><i class="icons fa fa-phone"></i>
                                        <a href="tel:{{$expert->phone}}" class="link">
                                            {{$expert->phone}}
                                        </a>
                                    </li>
                                    <li class="main-list">
                                        <i class="icons fa fa-envelope-o"></i>
                                        <a href="mailto:{{$expert->email}}" class="link">
                                            {{$expert->email}}
                                        </a>
                                    </li>
                                    <li class="main-list">
                                        <i class="icons fa fa-skype"></i>
                                        <a href="skype:{{ $expert->skype}}" class="link">
                                            {{$expert->skype}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>