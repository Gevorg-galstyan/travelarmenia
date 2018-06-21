<footer>
    <div class="hyperlink">
        <div class="container">
            <div class="slide-logo-wrapper">
                @foreach($partners as $partner)
                    <div class="logo-item">
                        <a href="{{$partner->link}}" class="link" target="_blank">
                            <img src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $partner->image))}}"
                                 alt="{{$partner->translate()->name}}"
                                 title="{{$partner->translate()->name}}"
                                 class="img-responsive"/>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="social-footer">
                <ul class="list-inline list-unstyled">
                    @foreach($social_links as $link)
                        <li>
                            <a href="{{$link->id == 4 ? 'mailto:'.$link->link : $link->link}}"
                               title="{{$link->translate()->name}}"
                               class="link facebook" target="_blank">
                                <i class="{{$link->icon}}"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="name-company">POWERED BY <a href="https://atomplanet.net/" target="_blank">ATOM PLANET</a></div>
        </div>
    </div>
</footer>