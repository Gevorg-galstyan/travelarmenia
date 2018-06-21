<header>
    <div class="bg-transparent header-01">
        <div class="header-topbar">
            <div class="container">
                <ul class="topbar-left list-unstyled list-inline pull-left">
                    <li><a href="javascript:void(0)" class="language dropdown-text"><span>
                                @if(session('locale') == 'en')
                                    English
                                @elseif(!session('locale') || session('locale') == 'ru')
                                    Русский
                                @endif
                            </span><i
                                    class="topbar-icon icons-dropdown fa fa-angle-down"></i></a>
                        <ul class="dropdown-topbar list-unstyled hide">

                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a rel="alternate"
                                       hreflang="{{ $localeCode }}"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                       class="link">
                                        <img src="{{asset('assets/icon/'.$properties['flag'] )}}" alt=""
                                             class="flag"> {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>

                    </li>
                    <li>
                        <a href="javascript:void(0)" class="monney dropdown-text">
                            <span id="currency">{!! strtoupper (session('valuta_marka')) !!}</span>
                            <i class="topbar-icon icons-dropdown fa fa-angle-down"></i></a>
                        <ul class="dropdown-topbar list-unstyled hide">
                            <li>
                                <a href="{{route('change_currency',['to_currency' => 'amd'])}}"
                                   id="amd"
                                   data-currency="amd"
                                   class="link {{Request::url() != route('transports') && Request::url() != route('apartments') ? 'change-currency' : ''}}
                                   {{session('valuta_marka') == 'amd' ? 'currency-active' : ''}}">
                                    AMD ֏
                                </a>
                            </li>
                            <li>
                                <a href="{{route('change_currency',['to_currency' => 'usd'])}}"
                                   id="usd"
                                   data-currency="usd"
                                   class="link {{Request::url() != route('transports') && Request::url() != route('apartments') ? 'change-currency' : ''}}
                                   {{session('valuta_marka') == 'usd' ? 'currency-active' : ''}}">
                                    USD $
                                </a>
                            </li>
                            <li>
                                <a href="{{route('change_currency' ,['to_currency' => 'eur'])}}"
                                   id="eur"
                                   data-currency="eur"
                                   class="link {{Request::url() != route('transports') && Request::url() != route('apartments') ? 'change-currency' : ''}}
                                   {{session('valuta_marka') == 'eur' ? 'currency-active' : ''}}">
                                    EUR &#8364
                                </a>
                            </li>
                            <li>
                                <a href="{{route('change_currency',['to_currency' => 'rub']) }}"
                                   id="rub"
                                   data-currency="rub"
                                   class="link {{Request::url() != route('transports') && Request::url() != route('apartments') ? 'change-currency' : ''}}
                                   {{session('valuta_marka') == 'rub' ? 'currency-active' : ''}}">
                                    RUB &#8381
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <div class="header-main-wrapper">
                    <div class="hamburger-menu">
                        <div class="hamburger-menu-wrapper">
                            <div class="icons"></div>
                        </div>
                    </div>
                    <div class="navbar-header">
                        <div class="logo">
                            <a href="{{route('home')}}" class="header-logo">
                                <img src="{{asset('storage/'.setting('site.logo'))}}"
                                     alt="{{config('app.name')}}"
                                     title="{{config('app.name')}}"/>
                            </a>
                        </div>
                    </div>
                    <nav class="navigation">
                        <ul class="nav-links nav navbar-nav">
                            <li class="{{Request::url() == route('home') ? 'active' : ''}}">
                                <a href="{{route('home')}}" class="main-menu">
                                    <span class="text">@lang('header.home')</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#0" class="main-menu">
                                    <span class="text">@lang('header.tours')</span>
                                    <span class="icons-dropdown"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-1">
                                    @foreach($countries as $country)
                                        <li>
                                            <a href="{{route('tours',['country' => $country->slug])}}"
                                               class="link-page">
                                                {{$country->translate()->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class=" dropdown {{Request::segment(1)  == 'hotels' || Request::segment(2) == 'hotels' ? 'active' : ''}}">
                                <a href="#0" class="main-menu">
                                    <span class="text">@lang('header.hotels')</span>
                                    <span class="icons-dropdown">
                                        <i class="fa fa-angle-down"></i>
                                    </span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-1 multi-level">
                                    @foreach($countries->where('id', '!=', 4) as $country)
                                        <li class="dropdown-submenu">
                                            <a href="{{route('hotels',['country' => $country->slug])}}"
                                               class="link-page dropdown-toggle"
                                               data-toggle="dropdown">
                                                {{$country->translate()->name}}
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-style">
                                                @foreach($country->cities as $city)
                                                    <li>
                                                        <a href="{{route('hotels',[
                                                        'country' => $country->slug,
                                                        'city' => $city->slug,
                                                        ])}}" class="">
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
                            <li class=" dropdown">
                                <a href="#0" class="main-menu">
                                    <span class="text">@lang('header.rent')</span>
                                    <span class="icons-dropdown">
                                        <i class="fa fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-1 multi-level">
                                    <li>
                                        <a href="{{route('transports')}}"
                                           class="link-page dropdown-toggle"
                                           data-toggle="dropdown">
                                            <span class="text">@lang('header.transports')</span>
                                        </a>
                                    </li>
                                    <li >
                                        <a href="{{route('apartments')}}"
                                           class="link-page dropdown-toggle"
                                           data-toggle="dropdown">
                                            <span class="text">@lang('header.apartments')</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('blog')}}" class="main-menu"><span
                                            class="text">@lang('header.blog')</span></a>
                            </li>
                            <li class="dropdown {{Request::url() == route('about',['country_slug' => '*']) ? 'active' : ''}}">
                                <a href=#0" class="main-menu">
                                    <span class="text">@lang('header.about')</span>
                                    <span class="icons-dropdown"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-1">
                                    <li>
                                        <a href="{{ route('about',['country_slug' => 'us'])}}"
                                           class="link-page">
                                            @lang('about.about_us')
                                        </a>
                                    </li>
                                    @foreach($countries->where('id', '!=', 4) as $country)
                                        <li>
                                            <a href="{{route('about',['country_slug' => $country->slug])}}"
                                               class="link-page">
                                                {{__('about.country.'.$country->id)}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="{{Request::url() == route('contact') ? 'active' : ''}}">
                                <a href="{{route('contact')}}" class="main-menu">
                                    <span class="text">@lang('header.contact')</span>
                                </a>
                            </li>

                            <li class="{{Request::segment(1) == 'review' || Request::segment(2) == 'review'?'active':''}}">
                                <a href="{{route('reviews')}}" class="main-menu">
                                    <span class="text">@lang('header.review')</span>
                                </a>
                            </li>

                            <li class="{{Request::segment(1) == 'faq' || Request::segment(2) == 'faq'?'active':''}}">
                                <a href="{{route('faq')}}" class="main-menu">
                                    <span class="text">@lang('header.faq')</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</header>