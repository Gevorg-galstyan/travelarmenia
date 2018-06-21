<!-- MENU MOBILE-->
<div class="wrapper-mobile-nav">

    <div class="header-main">
        <div class="menu-mobile">
            <ul class="nav-links nav navbar-nav">
                <li>
                    <a href="{{route('home')}}" class="main-menu">
                        <span class="text">@lang('header.home')</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#0" class="main-menu">
                        <span class="text">@lang('header.tours')</span>
                    </a>
                    <span class="icons-dropdown">
                        <i class="fa fa-angle-down"></i>
                    </span>
                    <ul class="dropdown-menu dropdown-menu-1">
                        @foreach($countries as $i =>  $country)
                            <li class="dropdown dropdown1">
                                <a href="{{route('tours',['country' => $country->slug])}}" class="main-menu link-page">
                                    <span class="text">{{$country->translate()->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#0" class="main-menu">
                        <span class="text">@lang('header.hotels')</span>
                    </a>
                    <span class="icons-dropdown">
                        <i class="fa fa-angle-down"></i>
                    </span>
                    <ul class="dropdown-menu dropdown-menu-1">

                        @foreach($countries->where('id', '!=', 4) as $i =>  $country)

                            <li class="dropdown dropdown1">
                                <a href="{{route('hotels',['country' => $country->slug])}}" class="main-menu link-page">
                                    <span class="text">{{$country->translate()->name}}</span>
                                </a>

                                <span class="icons-dropdown as">
                                       <i class="fa fa-angle-down"></i>
                                   </span>

                                <ul class="dropdown-menu dropdown-menu-1">
                                    @foreach($country->cities as $city)
                                        <li>
                                            <a href="{{route('hotels',[
                                                        'country' => $country->slug,
                                                        'city' => $city->slug,
                                                        ])}}"
                                               class="link-page sub-sub">
                                                {{$city->translate()->name}}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="">
                    <a href="{{route('excursions')}}" class="main-menu">
                        <span class="text">@lang('header.excursions')</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#0" class="main-menu">
                        <span class="text">@lang('header.tent')</span>
                    </a>
                    <span class="icons-dropdown">
                        <i class="fa fa-angle-down"></i>
                    </span>
                    <ul class="dropdown-menu dropdown-menu-1">

                        <li class="dropdown dropdown1">
                            <a href="{{route('transports')}}" class="main-menu link-page">
                                <span class="text">@lang('header.transports')</span>
                            </a>
                        </li>
                        <li class="dropdown dropdown1">
                            <a href="{{route('apartments')}}" class="main-menu link-page">
                                <span class="text">@lang('header.apartments')</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{route('blog')}}" class="main-menu"><span
                                class="text">@lang('blog.blog')</span></a>
                </li>
                <li class="dropdown">
                    <a href=#0" class="main-menu {{Request::url() == route('about', '*') ? 'active' : ''}}">
                        <span class="text">@lang('header.about')</span>

                    </a>
                    <span class="icons-dropdown"><i class="fa fa-angle-down"></i></span>
                    <ul class="dropdown-menu dropdown-menu-1">
                        <li>
                            <a href="{{ route('about',['country_slug' => 'us'])}}"
                               class="link-page">
                                @lang('header.us')
                            </a>
                        </li>
                        @foreach($countries->where('id', '!=', 4) as $country)
                            <li>
                                <a href="{{route('about',['country_slug' => $country->slug])}}"
                                   class="link-page">
                                    {{$country->translate()->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{route('contact')}}" class="main-menu">
                        <span class="text">@lang('header.contact')</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('reviews')}}" class="main-menu">
                        <span class="text">@lang('header.review')</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('faq')}}" class="main-menu">
                        <span class="text">@lang('header.faq')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>