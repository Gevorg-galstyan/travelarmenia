<div class="price-widget widget">
    <div class="title-widget">
        <div class="title">@lang('transport.price_for')  {!! session('valuta_marka') .' '. session('valuta_sinvol') !!}</div>
    </div>
    <div class="content-widget">
        <div class="price-wrapper">
            <div data-range_min="0" data-range_max="{{round(($maximal_price) / (session('valuta_val') ? session('valuta_val') : 1))}}"
                 data-cur_min="{{isset($price_min) && $price_min ? $price_min : '0'}}"
                 data-cur_max="@if(isset($price_max) && $price_max > 0){{$price_max}} @else {{round(($maximal_price) / (session('valuta_val') ? session('valuta_val') : 1))}} @endif"
                 class="nstSlider">
                <div class="leftGrip indicator">
                    <div class="number"></div>
                </div>
                <div class="rightGrip indicator">
                    <div class="number"></div>
                </div>
            </div>
            <div class="leftLabel">0</div>
            <div class="rightLabel" data-name="price">
                {{round(($maximal_price) / (session('valuta_val') ? session('valuta_val') : 1))}}
            </div>
        </div>
    </div>
</div>