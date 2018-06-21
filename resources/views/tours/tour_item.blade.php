<div class="tours-layout">
    <div class="image-wrapper">
        <a href="{{route('tour',['slug' => $tour->slug])}}"
           class="link">
            <img src="{{asset(Voyager::image($tour->thumbnail('tumb')))}}"
                 alt="{{$tour->translate('en')->title}}"
                 title="{{$tour->translate('en')->title}}"
                 class="img-responsive">
        </a>
        <div class="title-wrapper">

            <a href="#" class="title">
                {{$tour->translate()->title}}
            </a><i class="icons flaticon-circle"></i></div>

        @if($tour->sale)
            <div class="label-sale">
                <p class="text">sale</p>
                <p class="number">{{$tour->sale}}%</p>
            </div>
        @endif

    </div>
    <div class="content-wrapper">
        <ul class="list-info list-inline list-unstyle">
            @foreach($tour->types as $type)
                <li>
                    <a href="{{route('tours',['country' => $tour->country->slug, 'type' => $type->id])}}" class="link"
                       title="{{$type->translate()->name}}">
                        <span class="text number">
                            {!! $type->icon !!}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
        <ul class="list-info list-inline list-unstyle">
            <li>
                <a href="{{count($tour->comments) > 0 ? route('reviews',['tour_id' => $tour->id]) : '#0'}}"
                   class="link">
                    <i class="icons fa fa-comment"></i>
                    <span class="text number">
                        {{count($tour->comments)}}
                    </span>
                </a>
            </li>
        </ul>
        <div class="content">
            <div class="title">
                <div class="price">
                    @include('tours.price',['tour' => $tour])
                </div>
                <p class="for-price">
                    {{count($tour->destinations)}} days
                    {{count($tour->destinations) - 1}} nights
                </p>
            </div>
            <p class="text">
                {!! $tour->short_description !!}
            </p>
            <div class="group-btn-tours">
                <a href="{{route('tour',['slug' => $tour->slug])}}"
                   class="btn btn-transparent">
                   @lang('tours.book_now')
                </a>
            </div>
        </div>
    </div>
</div>