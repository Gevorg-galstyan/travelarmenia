@php
    $sale = false;
    $price = false;
    $discount_price = false;
        if ($tour->pricing && $tour->pricing->count()){
            $price_array = [];
            foreach (json_decode($tour->pricing->details,true) as $items){
                foreach ($items['column'] as $item){
                    $price_array[]=$item['value'];
                }
            }
            $price = min($price_array);
        }else{
            $price = $tour->price;
        }
        if ($tour->sale){
            $sale = ($price * $tour->sale) / 100;
            $discount_price = $price - $sale;
        }
@endphp


@if($sale)
    <span class="number price" data-name="price">
        <input type="hidden" data-name="origin_price"
               value="{{$discount_price}}">
        <span>
{{round($discount_price / (session('valuta_val')
? session('valuta_val') : 1))}}
</span>
    </span>
    <del class="number price" data-name="price">
        <input type="hidden" data-name="origin_price"
               value="{{$price}}">
        <span>
{{round($price  / (session('valuta_val') ?? 1))}}
</span>
    </del>
@else
    <span class="number price" data-name="price">
<input type="hidden" data-name="origin_price"
       value="{{$price}}">
<span>
{{round($price / (session('valuta_val') ?? 1))}}
</span>
</span>
@endif
<sup class="unit valuta_sinvol">{!! session('valuta_sinvol') !!}</sup>