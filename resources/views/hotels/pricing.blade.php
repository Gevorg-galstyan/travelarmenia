@php
    $pricing = [];
$price = false;
$sale = false;
if ($hotel->rooms->count()){
    foreach ($hotel->rooms as $room){
        foreach($room->seasons as $season){
            $pricing[]=$season->price;
        }
    }
$price = min($pricing);
$sale = $hotel->sale;
}


@endphp
@if($price > 0)
    @if(isset($echo_sale))
        @if($sale > 0)
            @if(isset($page))
                (sale off {{$sale}} %)
            @else

                <div class="label-sale">
                    <p class="text">sale</p>
                    <p class="number">{{$sale}}%</p>
                </div>
            @endif
        @endif
    @else
        @if($sale > 0)
            @if(isset($page))
                <span class="text">@lang('hotels.single.from')</span>
                <del class="number" data-name="price">
                    <input type="hidden" data-name="origin_price"
                           value="{{$price}}">
                    <span>
                        {{round($price / (session('valuta_val')
        ? session('valuta_val') : 1))}}
                    </span>
                </del>
                <span class="number" data-name="price">
                    <input type="hidden" data-name="origin_price"
                           value="{{$price - ($price / 100 * $sale)}}">
                    <span>
                        {{round(($price - ($price / 100 * $sale)) /
                        (session('valuta_val') ? session('valuta_val') : 1))}}
                    </span>
                </span>
                <sup class="unit valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
            @else
                <p class="for-price">@lang('hotels.single.for')</p>
                <div class="price">
                    <del class="number" data-name="price">
                        <input type="hidden" data-name="origin_price"
                               value="{{$price}}">
                        <span>
                            {{round($price / (session('valuta_val')
                            ? session('valuta_val') : 1))}}
                        </span>
                    </del>
                    <span class="number" data-name="price">
                        <input type="hidden" data-name="origin_price"
                               value="{{$price - ($price / 100 * $sale)}}">
                        <span>
                            {{round(($price - ($price / 100 * $sale)) /
                            (session('valuta_val') ? session('valuta_val') : 1))}}
                        </span>
                    </span>
                    <sup class="valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
                </div>
            @endif
        @else
            @if(isset($page))
                <span class="text">@lang('hotels.single.from')</span>
                <span class="number" data-name="price">
                    <input type="hidden" data-name="origin_price"
                           value="{{$price}}">
                    <span>
                        {{round($price / (session('valuta_val')
                            ? session('valuta_val') : 1))}}
                    </span>
                </span>
                <sup class="unit valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
            @else
                <p class="for-price">@lang('hotels.single.for')</p>
                <div class="price">

                    <span class="number" data-name="price">
                        <input type="hidden" data-name="origin_price"
                               value="{{$price}}">
                        <span>
                            {{round($price / (session('valuta_val')
                            ? session('valuta_val') : 1))}}
                        </span>
                </span>
                    <sup class="valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>
                </div>
            @endif
        @endif
    @endif

@else

@endif


