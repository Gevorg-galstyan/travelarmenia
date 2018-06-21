<div class="col-sm-12">
    <h3 class="title-style-2">
        {{$excursion->title}}
    </h3>
    <div class="hotels-layout">

        <div class="col-sm-12">
            <div class="car-rent-layout pull-right">
                <div class="content-wrapper ">
                    price per person
                    <div class="price">
                <span class="number" data-name="price">
                    <input type="hidden" data-name="origin_price"
                           value="{{$excursion->price}}">
                    <span>
                        {{round($excursion->price / (session('valuta_val')
                        ? session('valuta_val') : 1))}}
                    </span>
                </span>
                        <sup class="valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
                    </div>
                </div>
            </div>

        </div>
        @php($images = json_decode($excursion->images, true))
        @foreach($images as $img)
            <div class="col-lg-2">
                <div class="hovereffect">
                    <img class="img-responsive"
                         src="{{Voyager::image(str_replace('.jpg','-tumb.jpg', $img))}}"
                         alt="{{$excursion->translate()->title}}"
                         title="{{$excursion->translate()->title}}"
                         width="100%">
                    <a href="{{Voyager::image($img)}}"
                       data-fancybox-group="gallery-hotel"
                       title="{{$excursion->translate()->title}}"
                       class="wp-gallery glry-absolute fancybox thumb">
                        <div class="overlay">
                        </div>
                    </a>
                </div>
            </div>


        @endforeach
        <div class="col-md-12">
            {!! $excursion->translate()->description !!}
        </div>
        <div class="col-md-12">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="group-btn-tours">

                            <a href=""
                               class=" btn btn-maincolor btn-book-excursion"
                               data-target="{{$excursion->slug}}"
                               data-url="{{route('get_excursion_book',$excursion->slug )}}">
                                @lang('book_form.book now')
                            </a>
                        </div>
                    </div>
                    {{--                    @include('hotels.room_book')--}}
                </div>
            </div>
            <div class="col-md-2">
                @include('includes.change_currency')
            </div>
        </div>


    </div>
    <div class="timeline-book-block  book-tour" data-status="{{$excursion->slug}}">
    </div>
</div>

