<div class="find-widget find-hotel-widget widget new-style">
    <h4 class="title-widgets">BOOK TOUR</h4>
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="col-sm-12 text-center">
                <div class="col-md-2 col-md-offset-8">
                    @include('includes.change_currency')
                </div>
            </div>

            <div class="">
                <span>
                    @lang('book_form.Your Choosed') : {{$tour->translate()->title}}
                </span>
            </div>
            <div class="">
                @if($hotel_name)
                    <span>@lang('book_form.Hotel') : </span>
                    @if($hotel_slug)
                        <a href="{{route('hotel',['slug' => $hotel_slug])}}" target="_blank ">
                            {{ $hotel_name }}
                        </a>
                    @else
                        <span>{{$hotel_name}}</span>
                    @endif
                @endif
            </div>
            @if($count)
                @lang('book_form.On') : {{$count}}
            @endif
            <div class="">
              <span>
                     @lang('book_form.Price per person')  :
                  @if($price)
                      @if($tour->sale)
                          <del class="number price" data-name="price">
                                <input type="hidden" data-name="origin_price"
                                       value="{{$price}}">
                                <span>
                                    {{round($price / (session('valuta_val')
                                ? session('valuta_val') : 1))}}
                                </span>
                            </del>
                          <span class="number price" data-name="price">
                                <input type="hidden" data-name="origin_price"
                                       value="{{$price - ($price / 100 * $tour->sale)}}">
                                <span>
                                    {{round(($price - ($price / 100 * $tour->sale)) /
                                (session('valuta_val') ? session('valuta_val') : 1))}}
                                </span>
                            </span>
                      @else
                          <span class="number price" data-name="price">
                                 <input type="hidden" data-name="origin_price"
                                        value="{{$price}}">
                                <span>
                                {{round(($price) / (session('valuta_val') ? session('valuta_val') : 1))}}
                                </span>
                            </span>
                      @endif
                      <sup class="unit valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
                  @else
                      @lang('book_form.Send the application for the price we will contact you')
                  @endif
                </span>

            </div>
        </div>


    </div>
    <form class="content-widget book-now tour-book" action="{{route('get_tour_order',['slug' => $tour->slug])}}"
          method="post">
        {{csrf_field()}}
        @foreach($data as $k => $v)
            @if($k == 'tour' || $k == '_token')
                @continue
            @endif
            <input type="hidden" name="{{$k}}" value="{{$v}}">
        @endforeach
        <div class="form-content">
            @include('tours.form_content')
        </div>
    </form>
</div>

<script>
    var total_url = "{{route('get_tour_book_total',['slug' => $tour->slug])}}";
</script>

