<div class="special-offer margin-top70">
    <h3 class="title-style-2">special offer</h3>
    <div class="special-offer-list">
        @foreach($similarTours as $similarTour)
            <div class="special-offer-layout">
                <div class="image-wrapper">
                    <a href="{{route('tour',['slug' => $similarTour->slug])}}" class="link">
                        <img src="{{Voyager::image($similarTour->thumbnail('tumb'))}}"
                             alt="{{$similarTour->translate()->title}}"
                             title="{{$similarTour->translate()->title}}"
                             class="img-responsive">
                    </a>
                    <div class="title-wrapper">
                        <a href="{{route('tour',['slug' => $similarTour->slug])}}" class="title">
                            {{$similarTour->translate()->title}}
                        </a>
                        <i class="icons flaticon-circle"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>